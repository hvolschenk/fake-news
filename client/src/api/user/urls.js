import join from 'shared/urls';

const CURRENT = 'current';
const USER = 'user';

// eslint-disable-next-line import/prefer-default-export
export const userCurrent = () => join(USER, CURRENT);
