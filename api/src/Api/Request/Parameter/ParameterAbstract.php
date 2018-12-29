<?php
  namespace Rwdg\Api\Request\Parameter;
  abstract class ParameterAbstract implements ParameterInterface {

    protected $value;

    public function __construct() {
      $this->buildValue();
    }

    public function getValue(): array {
      return $this->value ?? [];
    }

    protected function setValue(array $value) {
      $this->value = $value;
    }

    abstract protected function buildValue();

  }
