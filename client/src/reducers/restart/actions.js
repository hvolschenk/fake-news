import action from 'payload-action-creator';

export const RESTART_FAILED = 'RESTART_FAILED';
export const RESTART_REQUESTED = 'RESTART_REQUESTED';
export const RESTART_SUCCEEDED = 'RESTART_SUCCEEDED';

export const restartFailed = action(RESTART_FAILED);
export const restartRequested = action(RESTART_REQUESTED);
export const restartSucceeded = action(RESTART_SUCCEEDED);
