<?php
  namespace Rwdg\Api\Model\Pool;
  class PoolSchema extends \Rwdg\Api\Model\SchemaAbstract {

    const FIELDS = [
      [
        'default' => '',
        'name' => 'name',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => true,
        'sort' => true,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          ['name' => 'maximumLength', 'parameters' => [255]],
        ],
      ],
      [
        'default' => '',
        'name' => 'numberOfQuestions',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'create' => true,
        'update' => true,
        'type' => 'integer',
        'validation' => []
      ],
    ];
    const MODULES = [];

  }
