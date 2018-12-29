<?php
  namespace Rwdg\Api\Action;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Request\RequestInterface;
  use Rwdg\Api\Response\ResponseInterface;
  use Rwdg\Connection\ConnectionInterface;
  class ActionFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Action\\';

    public static function makeAction(
      string $action,
      string $type,
      ConnectionInterface $connection,
      RequestInterface $request,
      ResponseInterface $response,
      User $user,
      ModelInterface $model,
      CollectionInterface $collection
    ): ActionInterface {
      return self::getClass(
        self::getClassNames($action, $type),
        $connection,
        $request,
        $response,
        $user,
        $model,
        $collection
      );
    }

    private static function getClassNames(string $action, string $type): array {
      return [
        self::TARGET_NAMESPACE . "$action\\$type",
        self::TARGET_NAMESPACE . "$action\\$action"
      ];
    }

    private static function getClass(
      array $classNames,
      ConnectionInterface $connection,
      RequestInterface $request,
      ResponseInterface $response,
      User $user,
      ModelInterface $model,
      CollectionInterface $collection
    ): ActionInterface {
      foreach ($classNames as $className) {
        if (self::checkClass($className)) {
          return new $className(
            $connection,
            $request,
            $response,
            $user,
            $model,
            $collection
          );
        }
      }
      throw new ActionException('ACTION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'ActionInterface']);
    }

  }
