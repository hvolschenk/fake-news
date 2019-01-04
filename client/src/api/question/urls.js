import join from 'shared/urls';

const RANDOM = 'random';
const QUESTION = 'question';

// eslint-disable-next-line import/prefer-default-export
export const questionRandom = () => join(QUESTION, RANDOM);
