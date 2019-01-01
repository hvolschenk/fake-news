import { shallow } from 'enzyme';
import React from 'react';

import Body from './body';

import Layout from './component';

let wrapper;

jest.mock('serviceworker-webpack-plugin/lib/runtime', () => ({ register: () => {} }));

beforeAll(() => {
  wrapper = shallow(<Layout />, { disableLifecycleMethods: true });
});

test('Renders the body', () => {
  expect(wrapper.find(Body).exists()).toBe(true);
});
