<?php
  namespace Hvolschenk\Utils;
  class Compose {

    public static function compose($value, array $functions) {
      return array_reduce($functions, function($result, $function) {
        return call_user_func($function, $result);
      }, $value);
    }

    public static function addClassNames(string $className, array $functions) {
      return array_map(function(string $className, string $function) {
        return self::addClassName($className, $function);
      }, self::buildClassNamesList($className, $functions), $functions);
    }

    private static function addClassName(string $className, string $function) {
      return [$className, $function];
    }

    private static function buildClassNamesList(string $className,
    array $functions) {
      return array_fill(0, count($functions), $className);
    }

  }
