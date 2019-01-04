<?php
  namespace Rwdg\Api\Collection\Question;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\Question\Question;
  class Question extends \Rwdg\Api\Collection\CollectionAbstract {

    public function random(): Question {
      $questions = $this->getConnection()->executeStatement('CALL question_getRandom()');
      $question = ModelFactory::makeModel('Question', $this->getConnection(), $this->getUser());
      $question->setValuesFromArray($questions[0]);
      return $question;
    }

  }
