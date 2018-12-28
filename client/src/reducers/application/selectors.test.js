import { application } from './selectors';

test('Fetches the application information from state', () => {
  const APPLICATION = 'APPLICATION';
  const expected = { application: APPLICATION };

  const actual = application({ app: { application: APPLICATION } });

  expect(actual).toEqual(expected);
});
