<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Search;
  class Search extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    protected function buildValue() {
      $this->setValue(['query' => $this->parameterString]);
    }

  }
