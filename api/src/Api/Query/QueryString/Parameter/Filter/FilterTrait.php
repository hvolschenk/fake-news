<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Filter;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait FilterTrait {

    private $filter;

    private function setFilter(Filter $filter) {
      $this->filter = $filter;
    }

    public function getFilter(): Filter {
      return $this->filter;
    }

    private function buildFilter(string $filterString) {
      $this->setFilter(ParameterFactory::makeParameter('Filter', $filterString));
    }

  }
