<?php
  namespace Rwdg\Api\Query\Section;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryException;
  use Rwdg\Api\Query\QueryString\QueryString;
  class SectionFactory {

    const TARGET_NAMESPACE = 'Rwdg\\Api\\Query\\Section\\';

    public static function makeSection(string $section, string $type, string $driver,
    QueryString $queryString, ModelInterface $model, int $parentId = null): SectionInterface {
      return self::getClass(self::getClassName($section, $driver), $type, $queryString, $model,
        $parentId);
    }

    private static function getClassName(string $type, string $driver): string {
      return self::TARGET_NAMESPACE . "$driver\\$type";
    }

    private static function getClass(string $className, string $type, QueryString $queryString,
    ModelInterface $model, int $parentId = null): SectionInterface {
      if (self::checkClass($className)) {
        return new $className($type, $queryString, $model, $parentId);
      }
      throw new QueryException('SECTION_CLASSNAME_NOT_FOUND');
    }

    private static function checkClass(string $className): bool {
      return class_exists($className) && isset(class_implements($className)
        [self::TARGET_NAMESPACE . 'SectionInterface']);
    }

  }
