import { userCurrent } from '../urls';

const mockGetAsync = jest.fn();

beforeAll(() => {
  jest.mock('shared/http', () => ({ getAsync: mockGetAsync }));
  // eslint-disable-next-line global-require
  const getUser = require('./index').default;
  getUser();
});

test('Calls \'getAsync\' with the correct parameters', () => {
  const OPTIONS = 'OPTIONS';
  const expected = { options: OPTIONS, url: userCurrent() };

  const actual = mockGetAsync.mock.calls[0][0];

  expect(actual).toEqual(expected);
});
