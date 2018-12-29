<?php
  namespace Rwdg\Api\Model\User\Authentication;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Model\User\UserException;
  use Rwdg\Connection\ConnectionInterface;
  class AuthenticationFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Model\\User\\Authentication\\';

    public static function makeAuthentication(string $type, User $user,
    ConnectionInterface $connection): AuthenticationInterface {
      return self::getClass(self::getClassName($type), $user, $connection);
    }

    public static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className, User $user,
    ConnectionInterface $connection): AuthenticationInterface {
      if (self::checkClass($className)) {
        return new $className($user, $connection);
      }
      throw new UserException('AUTHENTICATION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'AuthenticationInterface']);
    }

  }
