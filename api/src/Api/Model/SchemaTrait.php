<?php
  namespace Rwdg\Api\Model;
  trait SchemaTrait {

    private $schema;

    private function setSchema(SchemaInterface $schema) {
      $this->schema = $schema;
    }

    public function getSchema(): SchemaInterface {
      return $this->schema;
    }

    private function buildSchema(string $type) {
      $this->setSchema(SchemaFactory::makeSchema($type));
    }

  }
