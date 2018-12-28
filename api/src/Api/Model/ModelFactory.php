<?php
  namespace Rwdg\Api\Model;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  class ModelFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Model\\';

    public static function makeModel(
      string $type,
      ConnectionInterface $connection,
      User $user = null
    ): ModelInterface {
      return self::getClass(self::getClassName($type), $connection, $user);
    }

    public static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(
      string $className,
      ConnectionInterface $connection,
      User $user = null
    ): ModelInterface {
      if (self::checkClass($className)) {
        return new $className($connection, $user);
      }
      throw new ModelException('MODEL_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ModelInterface']);
    }

  }
