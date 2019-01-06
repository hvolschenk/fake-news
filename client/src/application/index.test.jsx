import { shallow } from 'enzyme';
import React from 'react';
import { Provider } from 'react-redux';
import { BrowserRouter } from 'react-router-dom';

import store from 'reducers/store';

import Routes from './routes';

import Application from './index';

let wrapper;

jest.mock('serviceworker-webpack-plugin/lib/runtime', () => ({ register: () => {} }));

beforeAll(() => {
  wrapper = shallow(<Application />);
});

test('Wraps the application in a redux provider', () => {
  expect(wrapper.find(Provider).props().store).toBe(store);
});

test('Renders the browser router', () => {
  expect(wrapper.find(BrowserRouter).exists()).toBe(true);
});

test('Renders the routes', () => {
  expect(wrapper.find(Routes).exists()).toBe(true);
});
