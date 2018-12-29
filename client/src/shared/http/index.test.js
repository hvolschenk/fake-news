const mockDelete = jest.fn();
const mockGet = jest.fn();
const mockPost = jest.fn();
const mockPut = jest.fn();

beforeAll(() => {
  jest.mock('./instance', () => ({
    delete: mockDelete,
    get: mockGet,
    post: mockPost,
    put: mockPut,
  }));
});

describe('.deleteAsync()', () => {
  const URL = 'URL';

  let deleteAsync;
  let parameters;

  beforeAll(() => {
    // eslint-disable-next-line global-require
    ({ deleteAsync } = require('./index'));
    deleteAsync({ url: URL });
    [parameters] = mockDelete.mock.calls;
  });

  test('Calls \'delete\' with the correct URL', () => {
    expect(parameters[0]).toBe(URL);
  });
});

describe('.getAsync()', () => {
  const QUERY = 'QUERY';
  const URL = 'URL';

  let getAsync;
  let parameters;

  beforeAll(() => {
    // eslint-disable-next-line global-require
    ({ getAsync } = require('./index'));
    getAsync({ query: QUERY, url: URL });
    [parameters] = mockGet.mock.calls;
  });

  test('Calls \'get\' with the correct URL', () => {
    expect(parameters[0]).toBe(URL);
  });

  test('Adds the query parameters to the call', () => {
    expect(parameters[1]).toEqual({ params: QUERY });
  });
});

describe('.postAsync()', () => {
  const PAYLOAD = 'PAYLOAD';
  const URL = 'URL';

  let postAsync;
  let parameters;

  beforeAll(() => {
    // eslint-disable-next-line global-require
    ({ postAsync } = require('./index'));
    postAsync({ payload: PAYLOAD, url: URL });
    [parameters] = mockPost.mock.calls;
  });

  test('Calls \'post\' with the correct URL', () => {
    expect(parameters[0]).toBe(URL);
  });

  test('Adds the payload to the call', () => {
    expect(parameters[1]).toEqual(PAYLOAD);
  });
});

describe('.putAsync()', () => {
  const PAYLOAD = 'PAYLOAD';
  const URL = 'URL';

  let putAsync;
  let parameters;

  beforeAll(() => {
    // eslint-disable-next-line global-require
    ({ putAsync } = require('./index'));
    putAsync({ payload: PAYLOAD, url: URL });
    [parameters] = mockPut.mock.calls;
  });

  test('Calls \'put\' with the correct URL', () => {
    expect(parameters[0]).toBe(URL);
  });

  test('Adds the payload to the call', () => {
    expect(parameters[1]).toEqual(PAYLOAD);
  });
});
