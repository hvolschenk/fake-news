import { applicationConnectedToggle } from './actions';

import reducer, { defaultState } from './index';

test('Returns the state by default', () => {
  expect(reducer()).toEqual(defaultState);
});

test('Toggles the connection status', () => {
  const TOGGLE = 'TOGGLE';
  const expected = { connected: TOGGLE };

  const actual = reducer({}, applicationConnectedToggle(TOGGLE));

  expect(actual).toEqual(expected);
});
