import { ui } from './selectors';

test('Fetches the ui information from state', () => {
  const UI = 'UI';
  const expected = { ui: UI };

  const actual = ui({ app: { ui: UI } });

  expect(actual).toEqual(expected);
});
