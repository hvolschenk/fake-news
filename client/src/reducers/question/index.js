import { reducer } from 'react-preloadr';

import { QUESTION_FAILED, QUESTION_REQUESTED, QUESTION_SUCCEEDED } from './actions';

export default reducer(QUESTION_FAILED, QUESTION_REQUESTED, QUESTION_SUCCEEDED);
