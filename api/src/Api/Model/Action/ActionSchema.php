<?php
  namespace Rwdg\Api\Model\Action;
  class ActionSchema extends \Rwdg\Api\Model\SchemaAbstract {

    const FIELDS = [
      [
        'default' => '',
        'name' => 'action',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          ['name' => 'maximumLength', 'parameters' => [16]],
        ],
      ],
      [
        'default' => '',
        'name' => 'result',
        'read' => true,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => false,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          ['name' => 'maximumLength', 'parameters' => [16]],
        ]
      ],
    ];
    const MODULES = [];

  }
