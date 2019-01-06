import { reducer } from 'react-preloadr';

import { USER_ADD_ANSWER, USER_FAILED, USER_REQUESTED, USER_SUCCEEDED } from './actions';

export default (state, action = {}) => {
  switch (action.type) {
    case USER_ADD_ANSWER:
      return {
        ...state,
        payload: {
          ...state.payload,
          action: [...state.payload.action, { action: 'ANSWER', id: 0, result: action.payload }],
        },
      };
    default:
      return reducer(USER_FAILED, USER_REQUESTED, USER_SUCCEEDED)(state, action);
  }
};
