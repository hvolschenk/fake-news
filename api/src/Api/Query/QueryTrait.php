<?php
  namespace Rwdg\Api\Query;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryString\QueryStringInterface;
  trait QueryTrait {

    private $query;

    private function setQuery(QueryInterface $query) {
      $this->query = $query;
    }

    public function getQuery(): QueryInterface {
      return $this->query;
    }

    protected function buildQuery(string $type, string $driver, QueryStringInterface $queryString,
    ModelInterface $model, int $parentId = null) {
      $this->setQuery(QueryFactory::makeQuery($type, $driver, $queryString, $model, $parentId));
    }

  }
