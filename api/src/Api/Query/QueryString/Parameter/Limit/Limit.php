<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Limit;
  class Limit extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    protected function buildValue() {
      $this->setValue(self::formatItem(self::splitParameterIntoItems(
        $this->getParameterString())));
    }

    protected static function formatItem(array $parameterItems): array {
      return [
        'limit' => self::getLimit($parameterItems),
        'offset' => self::getOffset($parameterItems)
      ];
    }

    private static function getLimit(array $parameterItems): int {
      $first = (int)$parameterItems[0];
      return (int)(isset($parameterItems[1]) ? $parameterItems[1] :
        ($first === 0 ? 10 : $first));
    }

    private static function getOffset(array $parameterItems): int {
      return isset($parameterItems[1]) ? (int)$parameterItems[0] : 0;
    }

  }
