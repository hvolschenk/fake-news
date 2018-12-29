import React from 'react';
import { hot } from 'react-hot-loader';
import { Provider } from 'react-redux';
import { BrowserRouter } from 'react-router-dom';

import store from 'reducers/store';

import ConnectionCheck from './connection-check';
import Analytics from './google-analytics';
import Routes from './routes';
import Scroll from './scroll-restoration';

const Application = () => (
  <Provider store={store}>
    <ConnectionCheck>
      <BrowserRouter>
        <Analytics>
          <Scroll>
            <Routes />
          </Scroll>
        </Analytics>
      </BrowserRouter>
    </ConnectionCheck>
  </Provider>
);

export default hot(module)(Application);
