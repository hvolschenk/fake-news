<?php
  namespace Rwdg\Api\Bootstrap;
  class BootstrapException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'BOOTSTRAP_CONNECTION_FAILED' => [
        'code' => '607001',
        'message' => 'The database connection failed. Please check your logs ' .
          'for more details.'
      ]
    ];

  }
