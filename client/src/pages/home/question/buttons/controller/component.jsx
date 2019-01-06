import PropTypes from 'prop-types';
import React from 'react';

const Controller = ({ fetchQuestion }) => (
  <button onClick={fetchQuestion} type="button">Next</button>
);

Controller.propTypes = {
  fetchQuestion: PropTypes.func.isRequired,
};

export default Controller;
