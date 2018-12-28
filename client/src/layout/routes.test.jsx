import { shallow } from 'enzyme';
import { select } from 'qa-utilities';
import React from 'react';
import { Route } from 'react-router-dom';

import { root } from 'application/urls';
import Home from 'pages/home/async';

import Routes from './routes';

let routes;
let wrapper;

beforeAll(() => {
  wrapper = shallow(<Routes />, { disableLifecycleMethods: true });
  routes = wrapper.find(Route);
});

describe('Renders the home route', () => {
  let props;

  beforeAll(() => {
    props = routes.find(select('route__home')).props();
  });

  test('Renders the correct component', () => {
    expect(props.component).toBe(Home);
  });

  test('Uses the correct path', () => {
    expect(props.path).toBe(root());
  });
});
