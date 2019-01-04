import { getAsync } from 'shared/http';

import { userCurrent } from '../urls';

export default () => getAsync({ url: userCurrent() });
