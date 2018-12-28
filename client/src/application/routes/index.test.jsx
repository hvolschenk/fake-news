import { select } from 'qa-utilities';
import { shallow } from 'enzyme';
import React from 'react';

import Layout from 'application/layout';
import { root } from 'application/urls';

import Routes from './index';

jest.mock('serviceworker-webpack-plugin/lib/runtime', () => ({ register: () => {} }));

test('Renders the root route', () => {
  const wrapper = shallow(<Routes />, { disableLifecycleMethods: true });
  const expectedComponent = Layout;
  const expectedPath = root();

  const props = wrapper.find(select('route__root')).props();
  const actualComponent = props.component;
  const actualPath = props.path;

  expect(actualComponent).toBe(expectedComponent);
  expect(actualPath).toBe(expectedPath);
});
