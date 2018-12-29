import { shallow } from 'enzyme';
import React from 'react';

import Footer from './footer';
import Routes from './routes';

import Body from './index';

let wrapper;

beforeAll(() => {
  wrapper = shallow(<Body />, { disableLifecycleMethods: true });
});

test('Renders the list of routes', () => {
  expect(wrapper.find(Routes).exists()).toBe(true);
});

test('Renders the footer', () => {
  expect(wrapper.find(Footer).exists()).toBe(true);
});
