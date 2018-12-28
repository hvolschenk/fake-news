<?php
  namespace Rwdg\Api\Model\Validation;
  class Validation extends ValidationAbstract {

    protected function validateBoolean($value): string {
      return in_array($value, [0, 1, '0', '1']) ? '' : 'ERROR_BOOLEAN_INVALID';
    }

    protected function validateDate($value, array $values): string {
      if (!empty($value)) {
        $d = \DateTime::createFromFormat('Y-m-d', $value);
        return $d && $d->format('Y-m-d') === $value ? '' : 'ERROR_DATE_INVALID';
      }
      return '';
    }

    protected function validateTime($value, array $values): string {
      if (!empty($value)) {
        return preg_match('/[0-9]+\:[0-9]+/', $value) ? '' : 'ERROR_TIME_INVALID';
      }
      return '';
    }

    protected function validateString($value, array $values): string {
      if (!empty($value)) {
        return is_string($value) ? '' : 'INVALID_STRING';
      }
      return '';
    }

    protected function validateInteger($value, array $values): string {
      if (!empty($value)) {
        return is_int((int)$value) ? '' : 'INVALID_INTEGER';
      }
      return '';
    }

    protected function validateMinimumLength($value, array $values, int $minimumLength): string {
      if ($minimumLength > 0) {
        return strlen($value) >= $minimumLength ? '' : 'STRING_TOO_SHORT';
      }
      return '';
    }

    protected function validateMaximumLength($value, array $values, int $maximumLength): string {
      if ($maximumLength > 0) {
        return strlen($value) <= $maximumLength ? '' : 'STRING_TOO_LONG';
      }
      return '';
    }

  }
