<?php
  namespace Rwdg\Connection;
  class ConnectionException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'DRIVER_OR_API_CLASSNAME_NOT_FOUND' => [
        'code' => 601001,
        'message' => 'The Driver or Api class for the database connection ' .
          ' was not found, please check your implementation of ' .
            'ConnectionFactory::makeConnection()'
      ]
    ];

  }
