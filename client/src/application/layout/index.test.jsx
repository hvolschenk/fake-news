import { shallow } from 'enzyme';
import React from 'react';

import Body from './body';
import Drawer from './drawer';
import Header from './header';

import Layout from './index';

let wrapper;

jest.mock('serviceworker-webpack-plugin/lib/runtime', () => ({ register: () => {} }));

const DIRECTION = 'ltr';

beforeAll(() => {
  wrapper = shallow(
    <Layout ui={{ direction: DIRECTION }} />,
    { disableLifecycleMethods: true },
  );
});

test('Passes the \'dir\' attribute to the root element', () => {
  expect(wrapper.props().dir).toBe(DIRECTION);
});

test('Renders the body', () => {
  expect(wrapper.find(Body).exists()).toBe(true);
});

test('Renders the drawer', () => {
  expect(wrapper.find(Drawer).exists()).toBe(true);
});

test('Renders the header', () => {
  expect(wrapper.find(Header).exists()).toBe(true);
});
