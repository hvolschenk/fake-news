import { action } from './selectors';

test('Fetches the action information from state', () => {
  const ACTION = 'ACTION';
  const expected = { action: ACTION };

  const actual = action({ app: { action: ACTION } });

  expect(actual).toEqual(expected);
});
