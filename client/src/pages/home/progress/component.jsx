import PropTypes from 'prop-types';
import React from 'react';

const getWidth = (action, pool) => Math.round((action.length / pool[0].numberOfQuestions) * 100);

const Progress = ({ user: { payload: { action, pool } } }) => (
  <div className="progress__total">
    <div
      className="progress__progress"
      style={{ width: `${getWidth(action, pool)}%` }}
    />
  </div>
);

Progress.propTypes = {
  user: PropTypes.shape({
    payload: PropTypes.shape({
      action: PropTypes.array.isRequired,
      pool: PropTypes.arrayOf(PropTypes.shape({
        numberOfQuestions: PropTypes.number.isRequired,
      })).isRequired,
    }).isRequired,
  }).isRequired,
};

export default Progress;
