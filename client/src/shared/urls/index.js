const DIVIDER = '/';
export const API = 'api';

export default (...sections) => `${DIVIDER}${sections.join(DIVIDER)}`;
