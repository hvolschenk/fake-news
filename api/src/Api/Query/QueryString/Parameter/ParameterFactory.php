<?php
  namespace Rwdg\Api\Query\QueryString\Parameter;
  use Rwdg\Api\Query\QueryException;
  class ParameterFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Query\\QueryString\\Parameter\\';

    public static function makeParameter(string $type,
    string $parameterString): ParameterInterface {
      return self::getClass(self::getClassName($type), $parameterString);
    }

    private static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className,
    string $parameterString): ParameterInterface {
      if (self::checkClass($className)) {
        return new $className($parameterString);
      }
      throw new QueryException('QUERY_STRING_PARAMETER_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ParameterInterface']);
    }

  }
