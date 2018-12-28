<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Search;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait SearchTrait {

    private $search;

    private function setSearch(Search $search) {
      $this->search = $search;
    }

    public function getSearch(): Search {
      return $this->search;
    }

    private function buildSearch(string $searchString) {
      $this->setSearch(ParameterFactory::makeParameter('Search', $searchString));
    }

  }
