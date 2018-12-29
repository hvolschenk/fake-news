import { shallow } from 'enzyme';
import React from 'react';

import Home from './index';

test('Renders the page', () => {
  const wrapper = shallow(<Home />, { disableLifecycleMethods: true });
  const expected = true;

  const actual = wrapper.exists();

  expect(actual).toBe(expected);
});
