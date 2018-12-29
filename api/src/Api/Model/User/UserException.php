<?php
  namespace Rwdg\Api\Model\User;
  class UserException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'AUTHENTICATION_CLASSNAME_NOT_FOUND' => [
        'code' => 602001,
        'message' => 'The Authentication class was not found, please check your ' .
        ' implementation of AuthenticationFactory::makeAuthentication()'
      ],
      'AUTHORIZATION_CLASSNAME_NOT_FOUND' => [
        'code' => 602002,
        'message' => 'The Authorization class was not found, please check your ' .
          ' implementation of AuthorizationFactory::makeAuthorization()'
      ]
    ];

  }
