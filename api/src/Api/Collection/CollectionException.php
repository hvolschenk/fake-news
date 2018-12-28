<?php
  namespace Rwdg\Api\Collection;
  class CollectionException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'COLLECTION_CLASSNAME_NOT_FOUND' => [
        'code' => 603001,
        'message' => 'The Collection class was not found, please check your ' .
          ' implementation of CollectionFactory::makeCollection()'
      ],
      'QUERY_STRING_PARAMETER_CLASSNAME_NOT_FOUND' => [
        'code' => 603002,
        'message' => 'The Query String Parameter class was not found, please ' .
          'check your implementation of ParameterFactory::makeParameter()'
      ],
      'QUERY_CLASSNAME_NOT_FOUND' => [
        'code' => 603003,
        'message' => 'The Query class was not found, please ' .
          'check your implementation of QueryFactory::makeQuery()'
      ],
      'SECTION_CLASSNAME_NOT_FOUND' => [
        'code' => 603004,
        'message' => 'The Query String Parameter class was not found, please ' .
          'check your implementation of SectionFactory::makeSection()'
      ],
      'TYPE_NOT_ALLOWED' => [
        'code' => 603005,
        'message' => 'The type you have selected is not allowed. Please make ' .
          'sure to add a Model class for it.'
      ],
      'SORT_NOT_ALLOWED' => [
        'code' => 603006,
        'message' => 'The sort column you have selected is not allowed.'
      ],
      'SORT_DIRECTION_NOT_ALLOWED' => [
        'code' => 603007,
        'message' => 'The sort direction you have chosen is not allowed.'
      ]
    ];

  }
