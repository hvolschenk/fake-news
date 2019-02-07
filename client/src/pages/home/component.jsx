import PropTypes from 'prop-types';
import React from 'react';

import Progress from './progress';
import Question from './question';

class Home extends React.Component {
  constructor(props) {
    super(props);
    this.isDone = this.isDone.bind(this);
  }

  isDone() {
    const { user: { payload: { action, pool } } } = this.props;
    return action.length === pool[0].numberOfQuestions;
  }

  render() {
    return (
      <div className="home-page">
        <Progress />
        <div className="headlineBox">
          <img className="home-page__headline" src="fake-news.png" alt="fake news logo"/>
        </div>
        <h2 className="home-page__subheading">Real or fake?</h2>
        {this.isDone() && 'DONE'}
        {!this.isDone() && <Question />}
      </div>
    );
  }
}

Home.propTypes = {
  user: PropTypes.shape({
    payload: PropTypes.shape({
      action: PropTypes.arrayOf(PropTypes.shape({
        action: PropTypes.string,
        result: PropTypes.string,
      })).isRequired,
      pool: PropTypes.arrayOf(PropTypes.shape({
        numberOfQuestions: PropTypes.number.isRequired,
      })).isRequired,
    }).isRequired,
  }).isRequired,
};

export default Home;
