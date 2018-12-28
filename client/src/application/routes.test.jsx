import { shallow } from 'enzyme';
import { select } from 'qa-utilities';
import React from 'react';

import Layout from 'layout';

import Routes from './routes';
import { root } from './urls';

describe('Renders only the root route', () => {
  let props;

  beforeAll(() => {
    const wrapper = shallow(<Routes />, { disableLifecycleMethods: true });
    props = wrapper.find(select('route__root')).props();
  });

  test('Renders the correct component', () => {
    expect(props.component).toBe(Layout);
  });

  test('Uses the correct path', () => {
    expect(props.path).toBe(root());
  });
});
