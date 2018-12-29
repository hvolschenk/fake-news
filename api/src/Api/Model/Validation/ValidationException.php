<?php
  namespace Rwdg\Api\Model\Validation;
  class ValidationException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'VALIDATION_CLASSNAME_NOT_FOUND' => [
        'code' => 609001,
        'message' => 'The Validation class was not found, please check your ' .
        ' implementation of ValidationFactory::makeValidation()'
      ],
      'INVALID_EMAIL_ADDRESS' => [
        'code' => 609002,
        'message' => 'The email address supplied is not valid'
      ],
      'INVALID_PASSWORD' => [
        'code' => 609003,
        'message' => 'The password supplied is not valid'
      ]
    ];
  }
