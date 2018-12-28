<?php
  namespace Rwdg\Api\Response;
  class ResponseException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'RESPONSE_CLASSNAME_NOT_FOUND' => [
        'code' => 605001,
        'message' => 'The Response class was not found, please check your implementation of ' .
          'ResponseFactory::makeResponse()'
      ],
      'OUTPUT_CLASSNAME_NOT_FOUND' => [
        'code' => 605002,
        'message' => 'The Output class was not found, please check your implementation of ' .
          'OutputFactory::makeOutput()'
      ]
    ];

  }
