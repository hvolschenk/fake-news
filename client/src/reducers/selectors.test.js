import { currentUrl, urlParameters } from './selectors';

test('\'currentUrl()\' selects the current active url', () => {
  const PATHNAME = 'PATHNAME';
  const expected = { currentUrl: PATHNAME };

  const actual = currentUrl(undefined, { location: { pathname: PATHNAME } });

  expect(actual).toEqual(expected);
});

test('\'urlParameters()\' selects the URL parameters', () => {
  const PARAMS = { key1: 'value1', key2: 'value2' };
  const expected = { urlParameters: PARAMS };

  const actual = urlParameters(undefined, { match: { params: PARAMS } });

  expect(actual).toEqual(expected);
});
