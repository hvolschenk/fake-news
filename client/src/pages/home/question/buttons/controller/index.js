import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { answerQuestion } from 'api/question';
import { actionFailed, actionRequested, actionSucceeded } from 'reducers/action/actions';
import { action } from 'reducers/action/selectors';
import { userAddAnswer } from 'reducers/user/actions';

import Boundary from './boundary';

const mapStateToProps = reduxSelectr(action);

const mapDispatchToProps = (dispatch, { answer, questionId }) => ({
  componentDidMount: () => {
    dispatch(actionRequested());
    const formData = new FormData();
    const isCorrect = answer === true;
    const result = isCorrect ? 'CORRECT' : 'INCORRECT';
    formData.append('action', 'ANSWER');
    formData.append('questionId', questionId);
    formData.append('result', result);
    answerQuestion(formData)
      .then(() => {
        dispatch(actionSucceeded());
        dispatch(userAddAnswer(result));
      })
      .catch(() => dispatch(actionFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Boundary);
