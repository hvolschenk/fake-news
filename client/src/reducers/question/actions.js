import action from 'payload-action-creator';

export const QUESTION_FAILED = 'QUESTION_FAILED';
export const QUESTION_REQUESTED = 'QUESTION_REQUESTED';
export const QUESTION_SUCCEEDED = 'QUESTION_SUCCEEDED';

export const questionFailed = action(QUESTION_FAILED);
export const questionRequested = action(QUESTION_REQUESTED);
export const questionSucceeded = action(QUESTION_SUCCEEDED);
