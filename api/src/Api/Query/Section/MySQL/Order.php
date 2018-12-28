<?php
  namespace Rwdg\Api\Query\Section\MySQL;
  use Rwdg\Api\Query\QueryException;
  use Rwdg\Api\Model\ModelFactory;
  class Order extends \Rwdg\Api\Query\Section\SectionAbstract {

    const ALLOWED_ORDER_DIRECTIONS = ['ASC', 'DESC'];

    protected function buildSection() {
      $orders = $this->getQueryStringOrders();
      $this->setSection(empty($orders) ? '' : self::removeFirstComma($this->addOrders()));
    }

    private static function addBeginning(): string {
      return 'ORDER BY ';
    }

    private function addOrders(): string {
      return array_reduce($this->getQueryStringOrders(), [$this, 'addOrder'],
        self::addBeginning());
    }

    private function addOrder(string $currentOrder,
    array $order): string {
      return "$currentOrder, " . self::addOrderTable($order['table']) .
        $this->addOrderColumn($order['column']) .
          $this->addOrderDirection($order['value']);
    }

    private static function addOrderTable(string $table): string {
      return self::getTableName($table);
    }

    private function addOrderColumn(string $column): string {
      $this->checkColumn($column);
      return "$column ";
    }

    private function addOrderDirection(string $direction) {
      $this->checkOrderDirection($direction);
      return "$direction ";
    }

    private static function getTableName(string $table = ''): string {
      if (empty($table)) {
        return $table;
      } else {
        self::checkType($table);
        return "$table.";
      }
    }

    private function getQueryStringOrders(): array {
      return $this->getQueryString()->getSortValue();
    }

    private static function removeFirstComma(string $order): string {
      return str_replace('ORDER BY ,', 'ORDER BY ', $order);
    }

    private function checkColumn(string $column) {
      if (!in_array($column, $this->getColumnNames())) {
        throw new QueryException('SORT_NOT_ALLOWED');
      }
    }

    private static function checkOrderDirection(string $direction) {
      if (!in_array($direction, self::ALLOWED_ORDER_DIRECTIONS)) {
        throw new QueryException('SORT_DIRECTION_NOT_ALLOWED');
      }
    }

    private static function checkType(string $type) {
      if (!in_array($type, self::getTableNames())) {
        throw new QueryException('TYPE_NOT_ALLOWED');
      }
    }

    private function getColumnNames(): array {
      return array_map(['self', 'getColumnName'], $this->getModel()->getSchema()->getFieldsSort());
    }

    private static function getColumnName(array $field): string {
      return $field['name'];
    }

  }
