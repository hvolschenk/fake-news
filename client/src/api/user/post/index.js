import { getAsync } from 'shared/http';

import { userRestart } from '../urls';

export default options => getAsync({ options, url: userRestart() });
