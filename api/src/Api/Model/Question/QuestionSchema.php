<?php
  namespace Rwdg\Api\Model\Question;
  class QuestionSchema extends \Rwdg\Api\Model\SchemaAbstract {

    const FIELDS = [
      [
        'default' => '',
        'name' => 'question',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          ['name' => 'maximumLength', 'parameters' => [255]],
        ],
      ],
      [
        'default' => 'answer',
        'name' => 'role',
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
