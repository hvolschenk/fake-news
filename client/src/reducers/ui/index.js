import { UI_TOGGLE_LEFT_NAVIGATION_CLOSED, UI_TOGGLE_LEFT_NAVIGATION_OPEN } from './actions';

export const defaultState = { leftNavigationOpen: false };

export default (state = defaultState, action = {}) => {
  switch (action.type) {
    case UI_TOGGLE_LEFT_NAVIGATION_CLOSED:
      return { ...state, leftNavigationOpen: false };
    case UI_TOGGLE_LEFT_NAVIGATION_OPEN:
      return { ...state, leftNavigationOpen: true };
    default:
      return state;
  }
};
