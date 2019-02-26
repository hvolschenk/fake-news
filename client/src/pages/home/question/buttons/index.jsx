import PropTypes from 'prop-types';
import React from 'react';

import Controller from './controller';

class Buttons extends React.Component {
  constructor(props) {
    super(props);
    this.state = { chosenAnswer: undefined };
    this.answerQuestion = this.answerQuestion.bind(this);
    this.hasAnswered = this.hasAnswered.bind(this);
  }

  answerQuestion(answer) {
    this.setState({ chosenAnswer: answer === true });
  }

  hasAnswered() {
    return this.state.chosenAnswer !== undefined;
  }

  render() {
    const {
      answerQuestion,
      hasAnswered,
      props: { fetchQuestion, questionId },
      state: { chosenAnswer },
    } = this;
    return (
      <React.Fragment>
        {!hasAnswered() && (
          <div className="question__answers">
            <div className="left">
              <button
                className="md-btn question__answer question__answer--real real"
                onClick={() => answerQuestion(true)}
                type="button"
              >
                Real
              </button>
              <p className="underButton">(r/nottheonion)</p>
            </div>
            <div className="right">
              <button
                className="md-btn question__answer question__answer--fake fake"
                onClick={() => answerQuestion(false)}
                type="button"
              >
                Fake
              </button>
              <p className="underButton">(r/theonion)</p>
            </div>
          </div>
        )}
        {hasAnswered() && (
          <Controller answer={chosenAnswer} fetchQuestion={fetchQuestion} questionId={questionId} />
        )}
      </React.Fragment>
    );
  }
}

Buttons.propTypes = {
  fetchQuestion: PropTypes.func.isRequired,
  questionId: PropTypes.number.isRequired,
};

export default Buttons;
