<?php
  namespace Rwdg\Api\Model;
  abstract class SchemaAbstract implements SchemaInterface {

    const FIELDS = [
      [
        'name' => 'id',
        'default' => '',
        'read' => true,
        'display' => true,
        'required' => false,
        'search' => true,
        'sort' => true,
        'create' => true,
        'update' => true,
        'table' => 'model',
        'type' => 'integer',
        'validation' => [],
      ],
      [
        'name' => 'type',
        'default' => '',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'table' => 'model',
        'type' => 'string',
        'validation' => [
          [ 'name' => 'maximumLength', 'parameters' => [1] ],
          [ 'name' => 'minimumLength', 'parameters' => [1] ]
        ],
      ],
      [
        'name' => 'dateCreated',
        'default' => '',
        'read' => true,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => true,
        'table' => 'model',
        'type' => 'date',
        'validation' => [],
      ],
      [
        'name' => 'dateModified',
        'default' => '',
        'read' => true,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => true,
        'table' => 'model',
        'type' => 'date',
        'validation' => [],
      ],
      [
        'name' => 'status',
        'default' => '',
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'table' => 'model',
        'type' => 'string',
        'validation' => [
          [ 'name' => 'maximumLength', 'parameters' => [1] ],
          [ 'name' => 'minimumLength', 'parameters' => [1] ]
        ],
      ],
      [
        'name' => 'createdBy',
        'default' => 0,
        'read' => true,
        'display' => true,
        'required' => true,
        'search' => false,
        'sort' => false,
        'table' => 'model',
        'type' => 'integer',
        'validation' => [
          [ 'name' => 'createdBy', 'parameters' => [] ]
        ],
      ],
      [
        'name' => 'validationErrors',
        'default' => 0,
        'read' => false,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => false,
        'table' => '',
        'type' => 'array',
        'validation' => [],
      ],
      [
        'name' => 'error',
        'default' => '',
        'read' => false,
        'display' => true,
        'required' => false,
        'search' => false,
        'sort' => false,
        'table' => '',
        'type' => 'string',
        'validation' => [],
      ]
    ];
    const MODULES = [];

    private $fieldInFieldNames;

    public function getFields(): array {
      return get_called_class()::FIELDS;
    }

    public function getFieldsSelect(): array {
      return array_filter($this->getAllFields(), ['self', 'getFieldSelect']);
    }

    public function getFieldsSearch(): array {
      return array_filter($this->getFields(), ['self', 'getFieldSearch']);
    }

    public function getFieldsDisplay(): array {
      return array_column(array_filter($this->getAllFields(), ['self', 'getFieldDisplay']), 'name');
    }

    public function getFieldsSort(): array {
      return array_filter($this->getFieldsSelect(), ['self', 'getFieldSort']);
    }

    public function getFieldsCreate(): array {
      return array_filter($this->getAllFields(), ['self', 'getFieldCreate']);
    }

    public function getFieldsUpdate(): array {
      return array_filter($this->getAllFields(), ['self', 'getFieldUpdate']);
    }

    private function getFieldSearch(array $field): bool {
      return $field['search'] === true;
    }

    private function getFieldDisplay(array $field): bool {
      return $field['display'] === true;
    }

    private function getFieldSort(array $field): bool {
      return $field['sort'] === true;
    }

    private function getFieldCreate(array $field): bool {
      return isset($field['create']) && $field['create'] === true;
    }

    private function getFieldUpdate(array $field): bool {
      return isset($field['update']) && $field['update'] === true;
    }

    public function getAllFields(): array {
      return array_merge($this->getFieldsModel(), $this->getFields());
    }

    public function getFieldsInArray(array $fieldInFieldNames): array {
      $this->setFieldInFieldNames($fieldInFieldNames);
      return array_filter($this->getFields(), [$this, 'getFieldIn']);
    }

    private static function getFieldSelect(array $field): bool {
      return $field['read'] === true;
    }

    private function getFieldsModel(): array {
      return self::FIELDS;
    }

    private function getFieldIn(array $field): bool {
      return in_array($field['name'], $this->getFieldInFieldNames());
    }

    private function getFieldKeys(): array {
      return array_keys($this->getFields());
    }

    private function setFieldInFieldNames(array $fieldInFieldNames) {
      $this->fieldInFieldNames = $fieldInFieldNames;
    }

    private function getFieldInFieldNames(): array {
      return $this->fieldInFieldNames;
    }

  }
