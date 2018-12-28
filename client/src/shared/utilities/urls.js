const DIVIDER = '/';

export default (...sections) => `${DIVIDER}${sections.join(DIVIDER)}`;
