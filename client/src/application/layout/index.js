import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { getUser } from 'api/user';
import { userFailed, userRequested, userSucceeded } from 'reducers/user/actions';
import { user } from 'reducers/user/selectors';

import Boundary from './boundary';

const mapStateToProps = reduxSelectr(user);

const mapDispatchToProps = dispatch => ({
  componentDidMount: () => {
    dispatch(userRequested());
    getUser({ params: { links: 'Action||limit=999|||Pool' } })
      .then(({ data }) => dispatch(userSucceeded(data)))
      .catch(() => dispatch(userFailed()));
  },
});

export default connect(mapStateToProps, mapDispatchToProps)(Boundary);
