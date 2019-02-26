import PropTypes from 'prop-types';
import React from 'react';

const getCorrectAnswers = actions => actions
  .filter(({ action }) => action === 'ANSWER')
  .filter(({ result }) => result === 'CORRECT')
  .length;

const Overview = ({
  createNewSession,
  user: { payload: { action, pool: [{ numberOfQuestions }] } },
}) => (
  <div className="overview">
    <p className="overview__score">
      You have
      &nbsp;
      <span className="overview__score__number overview__score__number--correct">
        {getCorrectAnswers(action)}
      </span>
      &nbsp;
      out of
      &nbsp;
      <span className="overview__score__number overview__score__number--total">
        {numberOfQuestions}
      </span>
      &nbsp;
      correct.
    </p>
    <button onClick={createNewSession} type="button">Restart</button>
  </div>
);

Overview.propTypes = {
  createNewSession: PropTypes.func.isRequired,
  user: PropTypes.shape({
    payload: PropTypes.shape({
      action: PropTypes.arrayOf(PropTypes.shape({
        action: PropTypes.oneOf(['ANSWER', 'QUESTION']).isRequired,
        result: PropTypes.oneOf(['CORRECT', 'INCORRECT']),
      })).isRequired,
      pool: PropTypes.arrayOf(PropTypes.shape({
        numberOfQuestions: PropTypes.number.isRequired,
      })).isRequired,
    }).isRequired,
  }).isRequired,
};

export default Overview;
