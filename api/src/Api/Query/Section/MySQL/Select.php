<?php
  namespace Rwdg\Api\Query\Section\MySQL;
  use Rwdg\Api\Model\ModelFactory;
  class Select extends \Rwdg\Api\Query\Section\SectionAbstract {

    private $tableName;

    protected function buildSection() {
      $this->setSection('SELECT DISTINCT ' . $this->buildFields() . ' FROM model ');
    }

    private function buildFields(): string {
      return array_reduce($this->getModel()->getSchema()->getFieldsSelect(), [$this, 'buildField'],
        '');
    }

    private function buildField(string $fields, array $field): string {
      return self::buildFieldComma($fields) .
        self::buildFieldTableAndColumn($field, $this->getType());
    }

    private static function buildFieldComma(string $fields) {
      return (strlen($fields) > 0) ? "$fields, " : $fields;
    }

    private static function buildFieldTableAndColumn(array $field, string $type) {
      return ($field['table'] ?? $type) . ".{$field['name']}";
    }

  }
