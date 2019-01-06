<?php
  namespace Rwdg\Api\Model\Question;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  class Question extends \Rwdg\Api\Model\ModelAbstract {

    public $answer;
    public $numComments;
    public $question;
    public $score;

  }
