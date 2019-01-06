import Lifecycler from 'lifecycler';
import PropTypes from 'prop-types';
import React from 'react';
import Preloadr, { preloadDefaultProp, preloadPropTypes } from 'react-preloadr';

import Component from './component';

const Boundary = ({ action, componentDidMount, fetchQuestion }) => (
  <Lifecycler componentDidMount={componentDidMount}>
    <Preloadr
      failed={() => <p>Failed to save your answer, try again.</p>}
      requested={() => <p>Saving answer</p>}
      status={action.status}
    >
      {() => <Component fetchQuestion={fetchQuestion} />}
    </Preloadr>
  </Lifecycler>
);

Boundary.propTypes = {
  action: PropTypes.shape({
    status: preloadPropTypes,
  }),
  componentDidMount: PropTypes.func.isRequired,
  fetchQuestion: PropTypes.func.isRequired,
};

Boundary.defaultProps = {
  action: {
    status: preloadDefaultProp,
  },
};

export default Boundary;
