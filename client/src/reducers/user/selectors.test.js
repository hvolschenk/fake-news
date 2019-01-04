import { user } from './selectors';

test('Fetches the user information from state', () => {
  const USER = 'USER';
  const expected = { user: USER };

  const actual = user({ app: { user: USER } });

  expect(actual).toEqual(expected);
});
