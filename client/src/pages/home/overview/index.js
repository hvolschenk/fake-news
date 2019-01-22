import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { restartUser } from 'api/user';
import { restartFailed, restartRequested, restartSucceeded } from 'reducers/restart/actions';
import { restart } from 'reducers/restart/selectors';
import { user } from 'reducers/user/selectors';

import Component from './component';

const mapStateToProps = reduxSelectr(restart, user);

const mapDispatchToProps = dispatch => ({
  createNewSession: () => {
    dispatch(restartRequested());
    restartUser()
      .then(() => {
        dispatch(restartSucceeded());
        window.location.reload();
      })
      .catch(() => dispatch(restartFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Component);
