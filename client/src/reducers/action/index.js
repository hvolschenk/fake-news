import { reducer } from 'react-preloadr';

import { ACTION_FAILED, ACTION_REQUESTED, ACTION_SUCCEEDED } from './actions';

export default reducer(ACTION_FAILED, ACTION_REQUESTED, ACTION_SUCCEEDED);
