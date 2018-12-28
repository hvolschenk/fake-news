let reactLoadableCall;

beforeAll(() => {
  const mockLoadable = jest.fn();
  jest.mock('react-loadable', () => mockLoadable);
  // eslint-disable-next-line global-require
  require('./async');

  [[reactLoadableCall]] = mockLoadable.mock.calls;
});

test('Loads the contact component', () => {
  expect(reactLoadableCall.loader()).toEqual(import('./index'));
});

test('Loads the empty loading component', () => {
  expect(reactLoadableCall.loading()).toBe(null);
});
