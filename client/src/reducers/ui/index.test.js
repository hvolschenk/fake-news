import { uiDirectionToggle, uiLeftNavigationToggle } from './actions';

import reducer, { defaultState } from './index';

test('Returns the state by default', () => {
  expect(reducer()).toEqual(defaultState);
});

test('Toggles the direction to \'rtl\'', () => {
  expect(reducer({ direction: 'ltr' }, uiDirectionToggle())).toEqual({ direction: 'rtl' });
});

test('Toggles the direction to \'ltr\'', () => {
  expect(reducer({ direction: 'rtl' }, uiDirectionToggle())).toEqual({ direction: 'ltr' });
});

test('Toggles the left navigation', () => {
  const TOGGLE = 'TOGGLE';
  const expected = { leftNavigationOpen: TOGGLE };

  const actual = reducer({}, uiLeftNavigationToggle(TOGGLE));

  expect(actual).toEqual(expected);
});
