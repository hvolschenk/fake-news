import React from 'react';

import Progress from './progress';
import Question from './question';

export default () => (
  <div className="home-page">
    <Progress />
    <h1 className="home-page__headline">Fake News</h1>
    <h2 className="home-page__subheading">Real or fake?</h2>
    <Question
      onAnswer={answer => console.log(answer)}
      question="Police found a hole in a man's backyard, they're looking into it"
    />
  </div>
);
