import { userRestart } from '../urls';

const mockGetAsync = jest.fn();

const PAYLOAD = 'PAYLOAD';

beforeAll(() => {
  jest.mock('shared/http', () => ({ getAsync: mockGetAsync }));
  // eslint-disable-next-line global-require
  const getUser = require('./index').default;
  getUser(PAYLOAD);
});

test('Calls \'getAsync\' with the correct parameters', () => {
  expect(mockGetAsync.mock.calls[0][0]).toEqual({ payload: PAYLOAD, url: userRestart() });
});
