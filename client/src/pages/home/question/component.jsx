import PropTypes from 'prop-types';
import React from 'react';

const Question = ({ onAnswer, question }) => (
  <div className="question">
    <h3 className="question__question">{question}</h3>
    <div className="question__answers">
      <button
        className="question__answers__real"
        onClick={() => onAnswer(true)}
        type="button"
      >
        Real
      </button>
      <button
        className="question__answers__fake"
        onClick={() => onAnswer(false)}
        type="button"
      >
        Fake
      </button>
    </div>
  </div>
);

Question.propTypes = {
  onAnswer: PropTypes.func.isRequired,
  question: PropTypes.string,
};

export default Question;
