import { getAsync } from 'shared/http';

import { questionRandom } from '../urls';

export default options => getAsync({ options, url: questionRandom() });
