import { uiLeftNavigationOpen } from './selectors';

test('\'uiLeftNavigationOpen()\' returns whether the left navigation is open', () => {
  const LEFT_NAVIGATION_OPEN = 'LEFT_NAVIGATION_OPEN';
  const expected = { uiLeftNavigationOpen: LEFT_NAVIGATION_OPEN };

  const actual = uiLeftNavigationOpen({
    app: { ui: { leftNavigationOpen: LEFT_NAVIGATION_OPEN } },
  });

  expect(actual).toEqual(expected);
});
