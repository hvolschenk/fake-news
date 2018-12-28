import PropTypes from 'prop-types';
import React from 'react';
import { withRouter } from 'react-router-dom';

export class ScrollRestoration extends React.Component {
  componentDidUpdate({ location }) {
    const { pathname } = this.props.location;
    if (pathname !== location.pathname) {
      window.scrollTo(0, 0);
    }
  }
  render() {
    return this.props.children;
  }
}

ScrollRestoration.propTypes = {
  children: PropTypes.node,
  location: PropTypes.shape({
    pathname: PropTypes.string,
  }),
};

ScrollRestoration.defaultProps = {
  children: null,
  location: { pathname: undefined },
};

export default withRouter(ScrollRestoration);
