<?php
  namespace Rwdg\Api\Action;
  class ActionException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'ACTION_CLASSNAME_NOT_FOUND' => [
        'code' => 606001,
        'message' => 'The Action class was not found, please check your ' .
          ' implementation of ActionFactory::makeAction()'
      ],
    ];

  }
