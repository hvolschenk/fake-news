<?php
  namespace Rwdg\Api\Query;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryString\QueryStringInterface;
  class QueryFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Query\\';

    public static function makeQuery(string $type, string $driver,
    QueryStringInterface $queryString, ModelInterface $model,
    int $parentId = null): QueryInterface {
      return self::getClass(self::getClassName($driver), $type, $driver, $queryString, $model,
        $parentId);
    }

    private static function getClassName(string $driver): string {
      return self::TARGET_NAMESPACE . "$driver\\$driver";
    }

    private static function getClass(string $className, string $type, string $driver,
    QueryStringInterface $queryString, ModelInterface $model,
    int $parentId = null): QueryInterface {
      if (self::checkClass($className)) {
        return new $className($type, $driver, $queryString, $model, $parentId);
      }
      throw new QueryException('QUERY_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'QueryInterface']);
    }

  }
