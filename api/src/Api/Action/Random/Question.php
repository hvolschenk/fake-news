<?php
  namespace Rwdg\Api\Action\Random;
  use Rwdg\Api\Model\Question\Question as QuestionModel;
  class Question extends \Rwdg\Api\Action\ActionAbstract {

    private $question;

    public function execute() {
      $this->read();
      $this->output();
    }

    private function read() {
      $this->setQuestion($this->getCollection()->random());
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getQuestion());
    }

    private function getQuestion(): QuestionModel {
      return $this->question;
    }

    private function setQuestion(QuestionModel $question) {
      $this->question = $question;
    }

  }
