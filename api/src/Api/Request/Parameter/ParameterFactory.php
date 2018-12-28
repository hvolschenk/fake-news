<?php
  namespace Rwdg\Api\Request\Parameter;
  use Rwdg\Api\Request\RequestException;
  class ParameterFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Request\\Parameter\\';

    public static function makeParameter(string $type): ParameterInterface {
      return self::getClass(self::getClassName($type));
    }

    public static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className): ParameterInterface {
      if (self::checkClass($className)) {
        return new $className();
      }
      throw new RequestException('PARAMETER_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ParameterInterface']);
    }

  }
