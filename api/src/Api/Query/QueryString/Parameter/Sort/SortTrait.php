<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Sort;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait SortTrait {

    private $sort;

    private function setSort(Sort $sort) {
      $this->sort = $sort;
    }

    public function getSort(): Sort {
      return $this->sort;
    }

    private function buildSort(string $sortString) {
      $this->setSort(ParameterFactory::makeParameter('Sort', $sortString));
    }

  }
