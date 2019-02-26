import PropTypes from 'prop-types';
import React from 'react';

import Buttons from './buttons';

const Question = ({ fetchQuestion, question }) => (
  <div className="question">
    <div className="newsLine"></div>
    <h3 className="question__question">{question.question}</h3>
    <div className="newsLine"></div>
    <Buttons fetchQuestion={fetchQuestion} questionId={question.id} />
  </div>
);

Question.propTypes = {
  fetchQuestion: PropTypes.func.isRequired,
  question: PropTypes.shape({
    id: PropTypes.number.isRequired,
    question: PropTypes.string.isRequired,
  }).isRequired,
};

export default Question;
