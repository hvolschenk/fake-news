import { reducer } from 'react-preloadr';

import { RESTART_FAILED, RESTART_REQUESTED, RESTART_SUCCEEDED } from './actions';

export default reducer(RESTART_FAILED, RESTART_REQUESTED, RESTART_SUCCEEDED);
