<?php
  namespace Rwdg\Api\Response\Output;
  use Rwdg\Api\Response\ResponseException;
  class OutputFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Response\\Output\\';

    public static function makeOutput(string $type): OutputInterface {
      return self::getClass(self::getClassName($type));
    }

    public static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className): OutputInterface {
      if (self::checkClass($className)) {
        return new $className();
      }
      throw new ResponseException('OUTPUT_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'OutputInterface']);
    }

  }
