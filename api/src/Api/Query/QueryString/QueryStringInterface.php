<?php
  namespace Rwdg\Api\Query\QueryString;
  interface QueryStringInterface {

    public function __construct(array $queryStringParameters);

    public function getSearchValue(): array;

    public function getSortValue(): array;

    public function getFilterValue(): array;

    public function getLimitValue(): array;

    public function getLinksValue(): array;

    public function getValue(): array;

  }
