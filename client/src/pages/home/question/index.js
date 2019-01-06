import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { getQuestion } from 'api/question';
import { questionFailed, questionRequested, questionSucceeded } from 'reducers/question/actions';
import { question } from 'reducers/question/selectors';

import Boundary from './boundary';

const mapStateToProps = reduxSelectr(question);

const mapDispatchToProps = dispatch => ({
  componentDidMount: () => {
    dispatch(questionRequested());
    getQuestion()
      .then(({ data }) => dispatch(questionSucceeded(data)))
      .catch(() => dispatch(questionFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Boundary);
