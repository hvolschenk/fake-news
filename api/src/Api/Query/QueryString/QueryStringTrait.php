<?php
  namespace Rwdg\Api\Query\QueryString;
  trait QueryStringTrait {

    protected $queryString;

    protected function setQueryString(QueryStringInterface $queryString) {
      $this->queryString = $queryString;
    }

    public function getQueryString(): QueryStringInterface {
      return $this->queryString;
    }

    protected function buildQueryString(array $queryStringParameters) {
      $this->setQueryString(QueryStringFactory::makeQueryString($queryStringParameters));
    }

  }
