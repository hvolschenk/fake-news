<?php
  namespace Rwdg\Api\Model\Validation\User;
  class User extends \Rwdg\Api\Model\Validation\Validation {

    protected function validateEmail($value, array $values): string {
      if (!empty($value)) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) === false ? 'INVALID_EMAIL_ADDRESS' : '';
      }
      return '';
    }

    protected function validatePassword($value, array $values): string {
      if (!empty($value)) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/', $value) ?
          '' : 'ERROR_PASSWORD_INVALID';
      }
      return '';
    }

  }
