<?php
  namespace Rwdg\Api\Model;
  use Rwdg\Api\Model\ModelException;
  class SchemaFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Model\\';

    public static function makeSchema(string $type): SchemaInterface {
      return self::getClass(self::getClassName($type));
    }

    private static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\{$type}Schema";
    }

    private static function getClass(string $className): SchemaInterface {
      if (self::checkClass($className)) {
        return new $className();
      }
      throw new ModelException('SCHEMA_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'SchemaInterface']);
    }

  }
