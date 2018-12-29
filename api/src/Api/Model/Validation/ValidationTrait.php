<?php
  namespace Rwdg\Api\Model\Validation;
  trait ValidationTrait {

    private $validation;

    private function setValidation(ValidationInterface $validation) {
      $this->validation = $validation;
    }

    public function getValidation(): ValidationInterface {
      return $this->validation;
    }

    private function hasValidation(): bool {
      return !empty($this->validation);
    }

    private function buildValidation(string $type, \Rwdg\Api\Model\ModelInterface $model) {
      if (!$this->hasValidation()) {
        $this->setValidation(ValidationFactory::makeValidation($type, $model));
      }
    }

  }
