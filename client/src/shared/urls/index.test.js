import join from './index';

test('\'join()\' strings together URL parts with a separator', () => {
  const A = 'A';
  const B = 'B';
  const C = 'C';
  const expected = `/${A}/${B}/${C}`;

  const actual = join(A, B, C);

  expect(actual).toBe(expected);
});

test('Works with no URL parts', () => {
  const expected = '/';

  const actual = join();

  expect(actual).toBe(expected);
});
