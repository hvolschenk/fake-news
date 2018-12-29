<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Limit;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait LimitTrait {

    private $limit;

    private function setLimit(Limit $limit) {
      $this->limit = $limit;
    }

    public function getLimit(): Limit {
      return $this->limit;
    }

    private function buildLimit(string $limitString) {
      $this->setLimit(ParameterFactory::makeParameter('Limit', $limitString));
    }

  }
