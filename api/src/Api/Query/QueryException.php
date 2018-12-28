<?php
  namespace Rwdg\Api\Query;
  class QueryException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'QUERY_STRING_PARAMETER_CLASSNAME_NOT_FOUND' => [
        'code' => 608001,
        'message' => 'The Query String Parameter class was not found, please ' .
          'check your implementation of ParameterFactory::makeParameter()'
      ],
      'QUERY_CLASSNAME_NOT_FOUND' => [
        'code' => 608002,
        'message' => 'The Query class was not found, please ' .
          'check your implementation of QueryFactory::makeQuery()'
      ],
      'SECTION_CLASSNAME_NOT_FOUND' => [
        'code' => 608003,
        'message' => 'The Query String Parameter class was not found, please ' .
          'check your implementation of SectionFactory::makeSection()'
      ],
      'TYPE_NOT_ALLOWED' => [
        'code' => 608004,
        'message' => 'The type you have selected is not allowed. Please make ' .
          'sure to add a Model class for it.'
      ],
      'SORT_NOT_ALLOWED' => [
        'code' => 608005,
        'message' => 'The sort column you have selected is not allowed.'
      ],
      'SORT_DIRECTION_NOT_ALLOWED' => [
        'code' => 608006,
        'message' => 'The sort direction you have chosen is not allowed.'
      ]
    ];

  }
