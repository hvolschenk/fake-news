<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Filter;
  class Filter extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    protected static function formatItem(array $itemKeyAndValue) {
      return [
        'table' => $itemKeyAndValue[0],
        'value' => $itemKeyAndValue[1]
      ];
    }

  }
