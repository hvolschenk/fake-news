<?php
  namespace Rwdg\Api\Action\Random;
  use Rwdg\Api\Model\Question\Question;
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

    private function getQuestion(): Question {
      return $this->question;
    }

    private function setQuestion(Question $question) {
      $this->question = $question;
    }

  }
