import { reducer } from 'react-preloadr';

import { USER_FAILED, USER_REQUESTED, USER_SUCCEEDED } from './actions';

export default reducer(USER_FAILED, USER_REQUESTED, USER_SUCCEEDED);
