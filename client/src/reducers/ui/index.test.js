import {
  UI_TOGGLE_LEFT_NAVIGATION_CLOSED,
  UI_TOGGLE_LEFT_NAVIGATION_OPEN,
  uiToggleLeftNavigationClosed,
  uiToggleLeftNavigationOpen,
} from './actions';
import reducer, { defaultState } from './index';

test('Returns the default state when no action is provided', () => {
  const expected = defaultState;

  const actual = reducer();

  expect(actual).toEqual(expected);
});

test(`Closes the left navigation with the ${UI_TOGGLE_LEFT_NAVIGATION_CLOSED} action`, () => {
  const expected = { leftNavigationOpen: false };

  const actual = reducer({}, uiToggleLeftNavigationClosed());

  expect(actual).toEqual(expected);
});

test(`Opens the left navigation with the ${UI_TOGGLE_LEFT_NAVIGATION_OPEN} action`, () => {
  const expected = { leftNavigationOpen: true };

  const actual = reducer({}, uiToggleLeftNavigationOpen());

  expect(actual).toEqual(expected);
});
