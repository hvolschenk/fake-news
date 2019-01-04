import { question } from './selectors';

test('Fetches the question information from state', () => {
  const QUESTION = 'QUESTION';
  const expected = { question: QUESTION };

  const actual = question({ app: { question: QUESTION } });

  expect(actual).toEqual(expected);
});
