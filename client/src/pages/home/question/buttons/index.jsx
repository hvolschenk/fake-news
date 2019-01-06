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
    const { answerQuestion, hasAnswered, props: { fetchQuestion }, state: { chosenAnswer } } = this;
    return (
      <React.Fragment>
        {!hasAnswered() && (
          <div className="question__answers">
            <button
              className="question__answer question__answer--real"
              onClick={() => answerQuestion(true)}
              type="button"
            >
              Real
            </button>
            <button
              className="question__answer question__answer--fake"
              onClick={() => answerQuestion(false)}
              type="button"
            >
              Fake
            </button>
          </div>
        )}
        {hasAnswered() && <Controller answer={chosenAnswer} fetchQuestion={fetchQuestion} />}
      </React.Fragment>
    );
  }
}

Buttons.propTypes = {
  fetchQuestion: PropTypes.func.isRequired,
};

export default Buttons;
