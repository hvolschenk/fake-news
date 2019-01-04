<?php
  namespace Rwdg\Api\Collection\Question;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\Question\Question as QuestionModel;
  class Question extends \Rwdg\Api\Collection\CollectionAbstract {

    public function random(): QuestionModel {
      $questions = $this->getConnection()->executeStatement(
        'CALL question_random(:sessionId)',
        ['sessionId' => $this->getUser()->get('sessionId')]
      );
      $question = ModelFactory::makeModel('Question', $this->getConnection(), $this->getUser());
      $question->setValuesFromArray($questions[0]);
      return $question;
    }

  }
