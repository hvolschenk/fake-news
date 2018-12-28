<?php
  namespace Rwdg\Api\Query\QueryString;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterInterface;
  class QueryString extends QueryStringAbstract {

    use \Rwdg\Api\Query\QueryString\Parameter\Filter\FilterTrait;
    use \Rwdg\Api\Query\QueryString\Parameter\Limit\LimitTrait;
    use \Rwdg\Api\Query\QueryString\Parameter\Links\LinksTrait;
    use \Rwdg\Api\Query\QueryString\Parameter\Search\SearchTrait;
    use \Rwdg\Api\Query\QueryString\Parameter\SearchExact\SearchExactTrait;
    use \Rwdg\Api\Query\QueryString\Parameter\Sort\SortTrait;

    private $queryStringParameters;

    public function __construct(array $queryStringParameters) {
      $this->setQueryStringParameters($queryStringParameters);
      $this->buildParameters();
    }

    public function getSearchValue(): array {
      return $this->getSearch()->getValue();
    }

    public function getSearchExactValue(): array {
      return $this->getSearchExact()->getValue();
    }

    public function getSortValue(): array {
      return $this->getSort()->getValue();
    }

    public function getFilterValue(): array {
      return $this->getFilter()->getValue();
    }

    public function getLimitValue(): array {
      return $this->getLimit()->getValue();
    }

    public function getLinksValue(): array {
      return $this->getLinks()->getValue();
    }

    public function getValue(): array {
      return [
        'search' => $this->getSearchValue(),
        'searchExact' => $this->getSearchExactValue(),
        'sort' => $this->getSortValue(),
        'filter' => $this->getFilterValue(),
        'limit' => $this->getLimitValue(),
        'links' => $this->getLinksValue()
      ];
    }

    private function setQueryStringParameters(array $queryStringParameters) {
      $this->queryStringParameters = $queryStringParameters;
    }

    private function getQueryStringParameters(): array {
      return $this->queryStringParameters;
    }

    private function buildParameters() {
      $parameters = $this->getQueryStringParameters();
      $this->buildSearch($parameters['search'] ?? '');
      $this->buildSearchExact($parameters['searchExact'] ?? '');
      $this->buildSort($parameters['sort'] ?? '');
      $this->buildFilter($parameters['filter'] ?? '');
      $this->buildLimit($parameters['limit'] ?? '');
      $this->buildLinks($parameters['links'] ?? '');
    }

  }
