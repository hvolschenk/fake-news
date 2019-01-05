import { postAsync } from 'shared/http';

import { questionAnswer } from '../urls';

export default payload => postAsync({ payload, url: questionAnswer() });
