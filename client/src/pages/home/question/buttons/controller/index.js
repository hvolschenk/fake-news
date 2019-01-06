import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { answerQuestion } from 'api/question';
import { actionFailed, actionRequested, actionSucceeded } from 'reducers/action/actions';
import { action } from 'reducers/action/selectors';
import { userAddAnswer } from 'reducers/user/actions';

import Boundary from './boundary';

const mapStateToProps = reduxSelectr(action);

const mapDispatchToProps = (dispatch, { answer }) => ({
  componentDidMount: () => {
    dispatch(actionRequested());
    const isCorrect = answer === 'TRUE';
    const formData = new FormData();
    formData.append('action', 'ANSWER');
    formData.append('result', isCorrect ? 'CORRECT' : 'INCORRECT');
    answerQuestion(formData)
      .then(() => {
        dispatch(actionSucceeded());
        dispatch(userAddAnswer(isCorrect));
      })
      .catch(() => dispatch(actionFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Boundary);
