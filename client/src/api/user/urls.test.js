import { userCurrent } from './urls';

test('Builds the \'current user\' URL correctly', () => {
  expect(userCurrent()).toBe('/user/current');
});
