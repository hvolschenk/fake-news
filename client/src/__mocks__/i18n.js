module.exports = new Proxy({}, {
  get: () => new Proxy({}, {
    get: (target, name) => {
      if (name === 'formatString') {
        return (localeKey, options) => JSON.stringify({ localeKey, options });
      }
      return name;
    },
  }),
});
