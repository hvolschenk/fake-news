import { API_BASE_URL, API_TIMEOUT } from './constants';

const mockCreate = jest.fn();

beforeAll(() => {
  jest.mock('axios', () => ({ create: mockCreate }));
  // eslint-disable-next-line global-require
  require('./instance');
});

test('Builds the correct parameters for the axios instance', () => {
  expect(mockCreate.mock.calls[0][0]).toEqual({
    baseURL: API_BASE_URL,
    headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
    timeout: API_TIMEOUT,
  });
});
