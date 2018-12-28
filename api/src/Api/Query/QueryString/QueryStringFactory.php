<?php
  namespace Rwdg\Api\Query\QueryString;
  class QueryStringFactory {

    public static function makeQueryString(array $queryStringParameters): QueryStringInterface {
      return self::getClass($queryStringParameters);
    }

    private static function getClass(array $queryStringParameters): QueryStringInterface {
      return new QueryString($queryStringParameters);
    }

  }
