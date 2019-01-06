import { questionRandom } from '../urls';

const mockGetAsync = jest.fn();

const OPTIONS = 'OPTIONS';

beforeAll(() => {
  jest.mock('shared/http', () => ({ getAsync: mockGetAsync }));
  // eslint-disable-next-line global-require
  const getUser = require('./index').default;
  getUser(OPTIONS);
});

test('Calls \'getAsync\' with the correct parameters', () => {
  expect(mockGetAsync.mock.calls[0][0]).toEqual({ options: OPTIONS, url: questionRandom() });
});
