import { qa } from 'qa-utilities';
import React from 'react';
import { Route } from 'react-router-dom';

import Layout from 'application/layout';
import { root } from 'application/urls';

export default () => <Route component={Layout} path={root()} {...qa('route__root')} />;
