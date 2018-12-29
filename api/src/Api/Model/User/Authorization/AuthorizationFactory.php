<?php
  namespace Rwdg\Api\Model\User\Authorization;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Model\User\UserException;
  class AuthorizationFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Model\\User\\Authorization\\';

    public static function makeAuthorization(string $type, User $user): AuthorizationInterface {
      return self::getClass(self::getClassName($type), $user);
    }

    public static function getClassName(string $type): string {
      return self::TARGET_NAMESPACE . "$type\\$type";
    }

    private static function getClass(string $className, User $user): AuthorizationInterface {
      if (self::checkClass($className)) {
        return new $className($user);
      }
      throw new UserException('AUTHORIZATION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'AuthorizationInterface']);
    }

  }
