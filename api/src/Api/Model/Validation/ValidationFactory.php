<?php
  namespace Rwdg\Api\Model\Validation;
  class ValidationFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Model\\Validation\\';

    public static function makeValidation(string $type,
    \Rwdg\Api\Model\ModelInterface $model): ValidationInterface {
      return self::getClass(self::getClassNames($type), $model);
    }

    private static function getClassNames(string $type): array {
      return [
        self::TARGET_NAMESPACE . "$type\\$type",
        self::TARGET_NAMESPACE . 'Validation'
      ];
    }

    private static function getClass(array $classNames,
    \Rwdg\Api\Model\ModelInterface $model): ValidationInterface {
      foreach ($classNames as $className) {
        if (self::checkClass($className)) {
          return new $className($model);
        }
      }
      throw new ValidationException('VALIDATION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ValidationInterface']);
    }
  }
