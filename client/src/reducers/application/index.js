import { APPLICATION_CONNECTED_TOGGLE } from './actions';

export const defaultState = {
  connected: navigator.onLine,
};

export default (state = defaultState, action = {}) => {
  switch (action.type) {
    case APPLICATION_CONNECTED_TOGGLE:
      return { ...state, connected: action.payload };
    default:
      return state;
  }
};
