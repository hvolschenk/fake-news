<?php
  namespace Rwdg\Api\Model;
  class ModelException extends \Rwdg\Exception\ExceptionAbstract {

    protected $exceptions = [
      'MODEL_CLASSNAME_NOT_FOUND' => [
        'code' => 602001,
        'message' => 'The Model class was not found, please check your ' .
          ' implementation of ModelFactory::makeModel()'
      ],
      'QUERY_CLASSNAME_NOT_FOUND' => [
        'code' => 602002,
        'message' => 'The Query class was not found, please ' .
          'check your implementation of QueryFactory::makeQuery()'
      ],
      'SECTION_CLASSNAME_NOT_FOUND' => [
        'code' => 602003,
        'message' => 'The Query String Parameter class was not found, please ' .
          'check your implementation of SectionFactory::makeSection()'
      ],
      'TYPE_NOT_ALLOWED' => [
        'code' => 602004,
        'message' => 'The type you have selected is not allowed.'
      ],
      'SCHEMA_CLASSNAME_NOT_FOUND' => [
        'code' => 602005,
        'message' => 'The Schema class was not found, please check your ' .
          ' implementation of SchemaFactory::makeSchema()'
      ]
    ];

  }
