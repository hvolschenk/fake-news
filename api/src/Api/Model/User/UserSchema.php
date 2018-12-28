<?php
  namespace Rwdg\Api\Model\User;
  class UserSchema extends \Rwdg\Api\Model\SchemaAbstract {

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
          ['name' => 'maximumLength', 'parameters' => [64]],
          ['name' => 'minimumLength', 'parameters' => [2]]
        ],
      ],
      [
        'default' => '',
        'name' => 'email',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => true,
        'sort' => true,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          ['name' => 'email', 'parameters' => []]
        ]
      ],
      [
        'default' => '',
        'name' => 'password',
        'read' => false,
        'display' => false,
        'required' => false,
        'search' => false,
        'sort' => false,
        'create' => true,
        'update' => true,
        'type' => 'string',
        'validation' => [
          [ 'name' => 'maximumLength', 'parameters' => [64] ],
          [ 'name' => 'minimumLength', 'parameters' => [10] ]
        ]
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
        'name' => 'token',
        'read' => false,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => false,
        'type' => 'string',
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
