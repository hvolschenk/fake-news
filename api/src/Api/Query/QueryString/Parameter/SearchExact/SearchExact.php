<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\SearchExact;
  class SearchExact extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    protected function buildValue() {
      $this->setValue(['query' => $this->parameterString]);
    }

  }
