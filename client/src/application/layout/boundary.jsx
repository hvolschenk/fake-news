import Lifecycler from 'lifecycler';
import PropTypes from 'prop-types';
import React from 'react';
import Preloadr, { preloadDefaultProp, preloadPropTypes } from 'react-preloadr';

import Component from './component';

const Boundary = ({ componentDidMount, user }) => (
  <Lifecycler componentDidMount={componentDidMount}>
    <Preloadr
      failed={() => <p>Failed to load your user session</p>}
      requested={() => <p>Loading user session</p>}
      status={user.status}
    >
      {() => <Component />}
    </Preloadr>
  </Lifecycler>
);

Boundary.propTypes = {
  componentDidMount: PropTypes.func.isRequired,
  user: PropTypes.shape({
    status: preloadPropTypes,
  }),
};

Boundary.defaultProps = {
  user: {
    status: preloadDefaultProp,
  },
};

export default Boundary;
