import { connect } from 'react-redux';
import reduxSelectr from 'redux-selectr';

import { user } from 'reducers/user/selectors';

import Component from './component';

const mapStateToProps = reduxSelectr(user);

export default connect(mapStateToProps)(Component);
