<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\SearchExact;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait SearchExactTrait {

    private $searchExact;

    private function setSearchExact(SearchExact $searchExact) {
      $this->searchExact = $searchExact;
    }

    public function getSearchExact(): SearchExact {
      return $this->searchExact;
    }

    private function buildSearchExact(string $searchString) {
      $this->setSearchExact(ParameterFactory::makeParameter('SearchExact', $searchString));
    }

  }
