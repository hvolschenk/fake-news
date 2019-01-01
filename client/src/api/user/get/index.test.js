import { userCurrent } from '../urls';

const mockGetAsync = jest.fn();

beforeAll(() => {
  jest.mock('shared/http', () => ({ getAsync: mockGetAsync }));
  // eslint-disable-next-line global-require
  const getUser = require('./index').default;
  getUser();
});

test('Calls \'getAsync\' with the correct parameters', () => {
  expect(mockGetAsync.mock.calls[0][0]).toEqual({ url: userCurrent() });
});
