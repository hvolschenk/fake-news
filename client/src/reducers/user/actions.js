import action from 'payload-action-creator';

export const USER_ADD_ANSWER = 'USER_ADD_ANSWER';

export const USER_FAILED = 'USER_FAILED';
export const USER_REQUESTED = 'USER_REQUESTED';
export const USER_SUCCEEDED = 'USER_SUCCEEDED';

export const userAddAnswer = action(USER_ADD_ANSWER);

export const userFailed = action(USER_FAILED);
export const userRequested = action(USER_REQUESTED);
export const userSucceeded = action(USER_SUCCEEDED);
