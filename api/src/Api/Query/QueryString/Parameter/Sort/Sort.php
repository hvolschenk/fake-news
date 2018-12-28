<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Sort;
  class Sort extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    protected static function formatItem(array $itemKeyAndValue) {
      $tableAndColumn = self::splitKeyIntoTableAndColumn($itemKeyAndValue[0]);
      return [
        'table' => $tableAndColumn[0],
        'column' => $tableAndColumn[1],
        'value' => $itemKeyAndValue[1] ?? 'ASC'
      ];
    }

  }
