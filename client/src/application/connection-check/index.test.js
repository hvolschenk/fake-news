const TOGGLE = 'TOGGLE';
const mockApplicationConnectedToggle = jest.fn().mockReturnValue(TOGGLE);

beforeAll(() => {
  jest.mock('reducers/application/actions', () => ({
    applicationConnectedToggle: mockApplicationConnectedToggle,
  }));
});

beforeEach(() => {
  jest.resetModules();
});

describe('mapDispatchToProps().applicationConnected() sets the application as connected', () => {
  const dispatch = jest.fn();

  beforeAll(() => {
    // eslint-disable-next-line global-require
    const { mapDispatchToProps } = require('./index');
    mapDispatchToProps(dispatch).applicationConnected();
  });

  test('Calls the action creator with \'true\'', () => {
    expect(mockApplicationConnectedToggle.mock.calls[0][0]).toBe(true);
  });

  test('Dispatches the result of the action creator', () => {
    expect(dispatch.mock.calls[0][0]).toBe(TOGGLE);
  });
});

describe('mapDispatchToProps().applicationDisconnected() sets the application as disconnected', () => {
  const dispatch = jest.fn();

  beforeAll(() => {
    // eslint-disable-next-line global-require
    const { mapDispatchToProps } = require('./index');
    mapDispatchToProps(dispatch).applicationDisconnected();
  });

  test('Calls the action creator with \'false\'', () => {
    expect(mockApplicationConnectedToggle.mock.calls[1][0]).toBe(false);
  });

  test('Dispatches the result of the action creator', () => {
    expect(dispatch.mock.calls[0][0]).toBe(TOGGLE);
  });
});
