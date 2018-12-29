/* eslint-disable no-console, no-restricted-globals */
const DEBUG = false;

const { assets } = global.serviceWorkerOption;

const VERSION = 'DEV-0.0.0';
const CACHE_NAME = `${VERSION}-${new Date().getTime()}`;

const assetsToCache = [
  ...assets,
  './',
  '/assets/icons/favicon.png',
  'https://fonts.googleapis.com/css?family=Open+Sans:300,400,500',
  'https://fonts.googleapis.com/icon?family=Material+Icons',
]
  .filter(path => !path.includes('hot-update'))
  .map(path => new URL(path, global.location).toString());

const debug = (...messages) => {
  if (DEBUG) {
    console.log(...messages);
  }
};

self.addEventListener('install', (event) => {
  debug('[SW] Install event');
  event.waitUntil(
    global.caches
      .open(CACHE_NAME)
      .then(cache => cache.addAll(assetsToCache))
      .then(() => debug('Cached assets: main', assetsToCache))
      .catch((error) => {
        console.error(error);
        throw error;
      }),
  );
});

self.addEventListener('activate', (event) => {
  debug('[SW] Activate event');
  event.waitUntil(
    global.caches.keys().then(cacheNames =>
      Promise.all(
        cacheNames.map(cacheName => (
          cacheName.indexOf(CACHE_NAME) === 0 ? null : global.caches.delete(cacheName)
        )),
      )),
  );
});

self.addEventListener('message', (event) => {
  if (event.data.action === 'skipWaiting') {
    if (self.skipWaiting) {
      self.skipWaiting();
      self.clients.claim();
    }
  }
});

self.addEventListener('fetch', (event) => {
  const { request } = event;
  if (request.method !== 'GET') {
    debug(`[SW] Ignore non GET request ${request.method}`);
    return;
  }

  const requestUrl = new URL(request.url);

  if (requestUrl.origin !== location.origin) {
    debug(`[SW] Ignore difference origin ${requestUrl.origin}`);
    return;
  }

  if (
    request.url.includes('/api')
    && !request.url.includes('/api/version')
    && !request.url.includes('/api/locale')
  ) {
    debug(`[SW] Ignore api call ${request.url}`);
    return;
  }

  if (request.url.includes('sockjs-node') || request.url.includes('hot-update')) {
    debug(`[SW] Ignore hot update call ${request.url}`);
    return;
  }

  const resource = global.caches.match(request).then((response) => {
    if (response) {
      debug(`[SW] fetch URL ${requestUrl.href} from cache`);
      return response;
    }

    return fetch(request)
      .then((responseNetwork) => {
        if (!responseNetwork || !responseNetwork.ok) {
          debug(`[SW] URL [${requestUrl.toString()}] wrong responseNetwork: ${
            responseNetwork.status
          } ${responseNetwork.type}`);
          return responseNetwork;
        }

        debug(`[SW] URL ${requestUrl.href} fetched`);

        const responseCache = responseNetwork.clone();

        global.caches
          .open(CACHE_NAME)
          .then(cache => cache.put(request, responseCache))
          .then(() => debug(`[SW] Cache asset: ${requestUrl.href}`));
        return responseNetwork;
      })
      .catch(() => (event.request.mode === 'navigate' ? global.caches.match('./') : null));
  });

  event.respondWith(resource);
});
