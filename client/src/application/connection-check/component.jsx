import PropTypes from 'prop-types';
import React from 'react';

class ConnectionCheck extends React.Component {
  componentDidMount() {
    const { applicationConnected, applicationDisconnected } = this.props;
    window.addEventListener('offline', applicationDisconnected);
    window.addEventListener('online', applicationConnected);
  }
  componentWillUnmount() {
    const { applicationConnected, applicationDisconnected } = this.props;
    window.removeEventListener('offline', applicationDisconnected);
    window.removeEventListener('online', applicationConnected);
  }
  render() {
    return this.props.children;
  }
}

ConnectionCheck.propTypes = {
  applicationConnected: PropTypes.func.isRequired,
  applicationDisconnected: PropTypes.func.isRequired,
  children: PropTypes.node.isRequired,
};

export default ConnectionCheck;
