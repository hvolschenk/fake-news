import join from 'shared/urls';

const ACTION = 'action';
const RANDOM = 'random';
const QUESTION = 'question';

export const questionAnswer = () => join(ACTION);
export const questionRandom = () => join(QUESTION, RANDOM);
