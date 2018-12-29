<?php
  namespace Rwdg\Api\Model\Validation;
  abstract class ValidationAbstract implements ValidationInterface {

    use \Rwdg\Api\Model\ModelTrait;

    private $modelValues;
    private $validationFields;

    public function __construct(\Rwdg\Api\Model\ModelInterface $model) {
      $this->setModel($model);
    }

    public function validate(array $fields = null): array {
      $validationResults = [];
      $this->buildModelValues();
      $this->buildValidationFields($fields);
      foreach ($this->getValidationFields() as $field) {
        $field = is_string($field) ? $this->getFieldByName($field) : $field;
        $validationResults[$field['name']] = $this->validateField($field);
      }
      return $validationResults;
    }

    private function validateField(array $field) {
      foreach (self::getFieldRules($field) as $rule) {
        $result = $this->validateFieldRule($field['name'], $rule);
        if (!empty($result)) {
          return $result;
        }
      }
      return null;
    }

    private function validateFieldRule(string $fieldName, array $rule) {
      $validationMethod = self::getValidationMethodName($rule['name']);
      if ($this->hasValidationMethod($validationMethod)) {
        return call_user_func_array([$this, $validationMethod],
          $this->getRuleParameters($fieldName, $rule));
      }
      return null;
    }

    private function getFieldByName(string $fieldName): array {
      $fields = array_filter($this->getModel()->getSchema()->getAllFields(),
        function(array $field) use ($fieldName) {
          return $field['name'] === $fieldName;
        });
      return reset($fields);
    }

    private static function getFieldRules(array $field): array {
      return array_merge([['name' => $field['type'], 'parameters' => []]], $field['validation']);
    }

    private function getRuleParameters(string $fieldName, array $rule): array {
      return array_merge([$this->getModel()->get($fieldName) ?? null, $this->getModelValues()],
        $rule['parameters']);
    }

    private function hasValidationMethod(string $validationMethodName) {
      return method_exists($this, $validationMethodName);
    }

    private static function getValidationMethodName(string $validationMethod): string {
      return $validationMethod ? 'validate' . ucfirst($validationMethod) : '';
    }

    private function filterValidationField(array $field) {
      return in_array($field['name'], $this->getValidationFields());
    }

    private function buildValidationFields(array $validationFields = null) {
      $this->setValidationFields($validationFields ?? $this->getModel()->getSchema()->getFields());
    }

    private function setValidationFields(array $validationFields = null) {
      $this->validationFields = $validationFields;
    }

    private function getValidationFields() {
      return $this->validationFields;
    }

    private function buildModelValues() {
      $this->modelValues = $this->getModel()->asArray();
    }

    private function getModelValues(): array {
      return $this->modelValues;
    }

  }
