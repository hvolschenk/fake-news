<?php
  namespace Rwdg\Api\Model;
  interface SchemaInterface {

    public function getFields(): array;

    public function getFieldsSelect(): array;

    public function getFieldsInArray(array $fielNames): array;

  }
