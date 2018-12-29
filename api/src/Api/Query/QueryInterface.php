<?php
  namespace Rwdg\Api\Query;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryString\QueryStringInterface;
  interface QueryInterface {

    public function __construct(string $type, string $driver, QueryStringInterface $queryString,
    ModelInterface $model, int $parentId = null);

    public function getQuery(): string;

  }
