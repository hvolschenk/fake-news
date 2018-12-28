import { shallow } from 'enzyme';
import React from 'react';

import Routes from './routes';

import Layout from './index';

test('Renders the routes', () => {
  const wrapper = shallow(<Layout />, { disableLifecycleMethods: true });
  const expected = true;

  const actual = wrapper.find(Routes).exists();

  expect(actual).toBe(expected);
});
