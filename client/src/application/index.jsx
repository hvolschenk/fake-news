import React from 'react';
import { hot } from 'react-hot-loader';
import { Provider } from 'react-redux';
import { BrowserRouter } from 'react-router-dom';

import store from 'reducers/store';

import Analytics from './google-analytics';
import Routes from './routes';
import Scroll from './scroll-restoration';

const Application = () => (
  <Provider store={store}>
    <BrowserRouter>
      <Scroll>
        <Analytics>
          <Routes />
        </Analytics>
      </Scroll>
    </BrowserRouter>
  </Provider>
);

export default hot(module)(Application);
