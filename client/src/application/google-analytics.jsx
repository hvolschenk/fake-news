import PropTypes from 'prop-types';
import React from 'react';
import { withRouter } from 'react-router-dom';

export class GoogleAnalytics extends React.Component {
  componentDidUpdate({ location }) {
    const { pathname } = this.props.location;
    if (pathname !== location.pathname) {
      window.gtag('config', 'UA-119555587-1', { page_path: pathname });
    }
  }
  render() {
    return this.props.children;
  }
}

GoogleAnalytics.propTypes = {
  children: PropTypes.node,
  location: PropTypes.shape({
    pathname: PropTypes.string,
  }),
};

GoogleAnalytics.defaultProps = {
  children: null,
  location: { pathname: undefined },
};

export default withRouter(GoogleAnalytics);
