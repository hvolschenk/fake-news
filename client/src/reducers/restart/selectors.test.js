import { restart } from './selectors';

test('Fetches the restart information from state', () => {
  const RESTART = 'RESTART';
  const expected = { restart: RESTART };

  const actual = restart({ app: { restart: RESTART } });

  expect(actual).toEqual(expected);
});
