import { questionRandom } from './urls';

test('Builds the \'random question\' URL correctly', () => {
  expect(questionRandom()).toBe('/question/random');
});
