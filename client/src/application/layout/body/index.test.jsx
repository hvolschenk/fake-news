import { shallow } from 'enzyme';
import React from 'react';

import Routes from './routes';

import Body from './index';

let wrapper;

beforeAll(() => {
  wrapper = shallow(<Body />, { disableLifecycleMethods: true });
});

test('Renders the list of routes', () => {
  expect(wrapper.find(Routes).exists()).toBe(true);
});
