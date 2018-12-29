import { root } from './urls';

test('Builds the \'root\' url', () => {
  expect(root()).toBe('/');
});
