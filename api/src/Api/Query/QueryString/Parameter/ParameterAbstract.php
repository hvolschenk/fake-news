<?php
  namespace Rwdg\Api\Query\QueryString\Parameter;
  abstract class ParameterAbstract implements ParameterInterface {

    const PARAMETER_ITEMS_DIVIDER = ',';
    const ITEM_KEY_AND_VALUE_DIVIDER = ':';
    const KEY_TABLE_AND_COLUMN_DIVIDER = '.';

    protected $parameterString;
    protected $value = [];

    public function __construct(string $parameterString) {
      $this->setParameterString($parameterString);
      $this->buildValue();
    }

    public function getValue(): array {
      return $this->value;
    }

    private function setParameterString(string $parameterString) {
      $this->parameterString = $parameterString;
    }

    protected function getParameterString(): string {
      return $this->parameterString;
    }

    protected function setValue(array $value) {
      $this->value = $value;
    }

    protected function buildValue() {
      $parameterString = $this->getParameterString();
      $this->setValue(empty($parameterString) ? [] : array_map(['self', 'buildItem'],
        self::splitParameterIntoItems($parameterString)));
    }

    private static function buildItem(string $itemString): array {
      return static::formatItem(self::splitItemIntoKeyAndValue($itemString));
    }

    protected static function formatItem(array $itemKeyAndValue) {
      $tableAndColumn = self::splitKeyIntoTableAndColumn($itemKeyAndValue[0]);
      return [
        'table' => $tableAndColumn[0],
        'column' => $tableAndColumn[1],
        'value' => $itemKeyAndValue[1]
      ];
    }

    protected static function splitParameterIntoItems(
    string $parameterString): array {
      return explode(self::PARAMETER_ITEMS_DIVIDER, $parameterString);
    }

    private static function splitItemIntoKeyAndValue(
    string $parameterStringItem): array {
      return explode(self::ITEM_KEY_AND_VALUE_DIVIDER, $parameterStringItem);
    }

    protected static function splitKeyIntoTableAndColumn(string $key): array {
      $tableAndColumn = self::splitKey($key);
      return [self::getTableFromKey($tableAndColumn),
        self::getColumnFromKey($tableAndColumn)];
    }

    private static function getTableFromKey(array $tableAndColumn): string {
      return self::keyHasTable($tableAndColumn) ? $tableAndColumn[0] : '';
    }

    private static function getColumnFromKey(array $tableAndColumn): string {
      return self::keyHasTable($tableAndColumn) ? $tableAndColumn[1] :
        $tableAndColumn[0];
    }

    private static function keyHasTable(array $tableAndColumn): bool {
      return isset($tableAndColumn[1]);
    }

    private static function splitKey(string $key): array {
      return explode(self::KEY_TABLE_AND_COLUMN_DIVIDER, $key);
    }

  }
