<?php
  namespace Rwdg\Api\Collection;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  class CollectionFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Collection\\';

    public static function makeCollection(string $type,
    ConnectionInterface $connection, User $user = null): CollectionInterface {
      return self::getClass(self::getClassName($type), $connection, $user);
    }

    private static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className,
    ConnectionInterface $connection, User $user = null): CollectionInterface {
      if (self::checkClass($className)) {
        return new $className($connection, $user);
      }
      throw new CollectionException('COLLECTION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'CollectionInterface']);
    }

  }
