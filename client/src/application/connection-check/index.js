import { connect } from 'react-redux';

import { applicationConnectedToggle } from 'reducers/application/actions';

import Component from './component';

export const mapDispatchToProps = dispatch => ({
  applicationConnected: () => dispatch(applicationConnectedToggle(true)),
  applicationDisconnected: () => dispatch(applicationConnectedToggle(false)),
});

export default connect(undefined, mapDispatchToProps)(Component);
