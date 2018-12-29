import { qa } from 'qa-utilities';
import React from 'react';
import { Route, Switch } from 'react-router-dom';

import { root } from 'application/urls';
import Home from 'pages/home/async';

export default () => (
  <Switch>
    <Route component={Home} exact path={root()} {...qa('route__home')} />
  </Switch>
);
