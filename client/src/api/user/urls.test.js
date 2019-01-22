import { userCurrent, userRestart } from './urls';

test('Builds the \'current user\' URL correctly', () => {
  expect(userCurrent()).toBe('/user/current');
});

test('Builds the \'restart user\' URL correctly', () => {
  expect(userRestart()).toBe('/user/restart');
});
