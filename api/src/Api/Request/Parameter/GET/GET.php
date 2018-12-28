<?php
  namespace Rwdg\Api\Request\Parameter\GET;
  class GET extends \Rwdg\Api\Request\Parameter\ParameterAbstract {

    public function getId(): int {
      return (int)$this->getValue()['id'] ?? 0;
    }

    public function getType(): string {
      return ucfirst($this->getValue()['type'] ?? '');
    }

    public function getAction() {
      $action = $this->getValue()['action'];
      return $action ? ucfirst($action) : null;
    }

    protected function buildValue() {
      $this->setValue($_GET ?? []);
    }

  }
