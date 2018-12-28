<?php
  namespace Rwdg\Connection;
  class ConnectionFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Connection\\';

    public static function makeConnection(string $driver,
    string $api): ConnectionInterface {
      return self::getClass(self::getClassName($driver, $api));
    }

    private static function getClassName(string $driver, string $api): string {
      return self::TARGET_NAMESPACE . "$driver\\$api";
    }

    private static function getClass(string $className): ConnectionInterface {
      if (self::checkClass($className)) {
        return new $className;
      }
      throw new ConnectionException('DRIVER_OR_API_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ConnectionInterface']);
    }

  }
