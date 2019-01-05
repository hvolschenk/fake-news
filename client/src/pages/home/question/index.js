import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { answerQuestion, getQuestion } from 'api/question';
import { questionFailed, questionRequested, questionSucceeded } from 'reducers/question/actions';
import { question } from 'reducers/question/selectors';

import Boundary from './boundary';

const mapStateToProps = reduxSelectr(question);

const mapDispatchToProps = dispatch => ({
  answerQuestion: () => {
    answerQuestion()
      .then(() => { console.log('answered'); })
      .catch(() => { console.log('error'); });
  },
  componentDidMount: () => {
    questionRequested();
    getQuestion()
      .then(({ data }) => dispatch(questionSucceeded(data)))
      .catch(() => dispatch(questionFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Boundary);
