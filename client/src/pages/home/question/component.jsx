import PropTypes from 'prop-types';
import React from 'react';

import Buttons from './buttons';

const Question = ({ fetchQuestion, question }) => (
  <div className="question">
    <h3 className="question__question">{question}</h3>
    <Buttons fetchQuestion={fetchQuestion} />
  </div>
);

Question.propTypes = {
  fetchQuestion: PropTypes.func.isRequired,
  question: PropTypes.string.isRequired,
};

export default Question;
