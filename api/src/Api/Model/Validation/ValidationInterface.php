<?php
  namespace Rwdg\Api\Model\Validation;
  interface ValidationInterface {

    public function __construct(\Rwdg\Api\Model\ModelInterface $model);

    public function validate(array $values = null): array;

  }
