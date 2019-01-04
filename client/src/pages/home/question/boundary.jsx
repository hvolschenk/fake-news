import Lifecycler from 'lifecycler';
import PropTypes from 'prop-types';
import React from 'react';
import Preloadr, { preloadDefaultProp, preloadPropTypes } from 'react-preloadr';

import Component from './component';

const Boundary = ({ componentDidMount, question }) => (
  <Lifecycler componentDidMount={componentDidMount}>
    <Preloadr
      failed={() => <p>Failed to load your question</p>}
      requested={() => <p>Loading question</p>}
      status={question.status}
    >
      {() => (
        <Component
          question={question.payload.question}
          onAnswer={answer => console.log(answer)}
        />
      )}
    </Preloadr>
  </Lifecycler>
);

Boundary.propTypes = {
  componentDidMount: PropTypes.func.isRequired,
  question: PropTypes.shape({
    payload: PropTypes.shape({
      question: PropTypes.string,
    }),
    status: preloadPropTypes,
  }),
};

Boundary.defaultProps = {
  question: {
    payload: {},
    status: preloadDefaultProp,
  },
};

export default Boundary;
