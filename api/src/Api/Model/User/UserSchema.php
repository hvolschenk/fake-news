<?php
  namespace Rwdg\Api\Model\User;
  class UserSchema extends \Rwdg\Api\Model\SchemaAbstract {

    const FIELDS = [
      [
        'default' => '',
        'name' => 'sessionId',
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
      [
        'default' => '',
        'name' => 'privileges',
        'read' => false,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => false,
        'type' => 'array',
        'validation' => []
      ]
    ];
    const MODULES = [];

  }
