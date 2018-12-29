import { UI_DIRECTION_TOGGLE, UI_LEFT_NAVIGATION_TOGGLE } from './actions';

export const defaultState = {
  direction: 'ltr',
  leftNavigationOpen: false,
};

export default (state = defaultState, action = {}) => {
  switch (action.type) {
    case UI_DIRECTION_TOGGLE:
      return { ...state, direction: state.direction === 'ltr' ? 'rtl' : 'ltr' };
    case UI_LEFT_NAVIGATION_TOGGLE:
      return { ...state, leftNavigationOpen: action.payload };
    default:
      return state;
  }
};
