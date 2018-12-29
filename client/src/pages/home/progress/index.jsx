import PropTypes from 'prop-types';
import React from 'react';

const Progress = ({ progress, total }) => (
  <div className="progress__total">
    <div className="progress__progress" style={{ width: `${(progress / total) * 100}%` }} />
  </div>
);

Progress.propTypes = {
  progress: PropTypes.number,
  total: PropTypes.number,
};

Progress.defaultProps = {
  progress: 0,
  total: 100,
};

export default Progress;
