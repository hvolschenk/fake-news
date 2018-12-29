import { shallow } from 'enzyme';
import React from 'react';

import ConnectionCheck from './component';

const APPLICATION_CONNECTED = () => 'APPLICATION_CONNECTED';
const APPLICATION_DISCONNECTED = () => 'APPLICATION_DISCONNECTED';
const addEventListener = jest.fn();
const removeEventListener = jest.fn();
const Children = () => <p>Children</p>;

let wrapper;

beforeAll(() => {
  global.addEventListener = addEventListener;
  global.removeEventListener = removeEventListener;
  wrapper = shallow(
    <ConnectionCheck
      applicationConnected={APPLICATION_CONNECTED}
      applicationDisconnected={APPLICATION_DISCONNECTED}
    >
      <Children />
    </ConnectionCheck>,
  );
});

test('Renders the child component', () => {
  expect(wrapper.find(Children).exists()).toBe(true);
});

describe('Adds the necessary event listeners when the component mounts', () => {
  describe('Adds the disconnected event listener', () => {
    let parameters;

    beforeAll(() => {
      [parameters] = addEventListener.mock.calls;
    });

    test('Adds the listener for \'offline\'', () => {
      expect(parameters[0]).toBe('offline');
    });

    test('Passes the offline methods to the \'offline\' event listener', () => {
      expect(parameters[1]).toBe(APPLICATION_DISCONNECTED);
    });
  });

  describe('Adds the connected event listener', () => {
    let parameters;

    beforeAll(() => {
      [, parameters] = addEventListener.mock.calls;
    });

    test('Adds the listener for \'online\'', () => {
      expect(parameters[0]).toBe('online');
    });

    test('Passes the online methods to the \'online\' event listener', () => {
      expect(parameters[1]).toBe(APPLICATION_CONNECTED);
    });
  });
});

describe('Removes the necessary event listeners when the component unmounts', () => {
  beforeAll(() => {
    wrapper.unmount();
  });

  describe('Removes the disconnected event listener', () => {
    let parameters;

    beforeAll(() => {
      [parameters] = removeEventListener.mock.calls;
    });

    test('Removes the listener for \'offline\'', () => {
      expect(parameters[0]).toBe('offline');
    });

    test('Passes the offline methods to the \'offline\' event listener', () => {
      expect(parameters[1]).toBe(APPLICATION_DISCONNECTED);
    });
  });

  describe('Removes the connected event listener', () => {
    let parameters;

    beforeAll(() => {
      [, parameters] = removeEventListener.mock.calls;
    });

    test('Removes the listener for \'online\'', () => {
      expect(parameters[0]).toBe('online');
    });

    test('Passes the online methods to the \'online\' event listener', () => {
      expect(parameters[1]).toBe(APPLICATION_CONNECTED);
    });
  });
});
