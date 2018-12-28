<?php
  namespace Rwdg\Api\Request;
  class RequestException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'REQUEST_CLASSNAME_NOT_FOUND' => [
        'code' => 604001,
        'message' => 'The Request class was not found, please check your implementation of ' .
          'RequestFactory::makeRequest()'
      ],
      'PARAMETER_CLASSNAME_NOT_FOUND' => [
        'code' => 604002,
        'message' => 'The Parameter class was not found, please check your ' .
          ' implementation of ParameterFactory::makeParameter()'
      ]
    ];

  }
