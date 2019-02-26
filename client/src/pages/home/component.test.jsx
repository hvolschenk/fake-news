import { shallow } from 'enzyme';
import React from 'react';

import Home from './component';

test('Renders the page', () => {
  const wrapper = shallow(
    <Home user={{ payload: { action: [], pool: [{ numberOfQuestions: 1 }] } }} />,
    { disableLifecycleMethods: true },
  );
  const expected = true;

  const actual = wrapper.exists();

  expect(actual).toBe(expected);
});
