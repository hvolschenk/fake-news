import { getAsync } from 'shared/http';

import { userCurrent } from '../urls';

export default options => getAsync({ options, url: userCurrent() });
