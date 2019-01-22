import join from 'shared/urls';

const CURRENT = 'current';
const RESTART = 'restart';
const USER = 'user';

export const userCurrent = () => join(USER, CURRENT);
export const userRestart = () => join(USER, RESTART);
