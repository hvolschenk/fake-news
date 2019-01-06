import action from 'payload-action-creator';

export const ACTION_FAILED = 'ACTION_FAILED';
export const ACTION_REQUESTED = 'ACTION_REQUESTED';
export const ACTION_SUCCEEDED = 'ACTION_SUCCEEDED';

export const actionFailed = action(ACTION_FAILED);
export const actionRequested = action(ACTION_REQUESTED);
export const actionSucceeded = action(ACTION_SUCCEEDED);
