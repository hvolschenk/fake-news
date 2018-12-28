<?php
  namespace Rwdg\Api\Query\Section\MySQL;
  use Rwdg\Api\Query\QueryException;
  use Rwdg\Api\Query\QueryAbstract;
  class Join extends \Rwdg\Api\Query\Section\SectionAbstract {

    private $joinedFilters = [];

    protected function buildSection() {
      $this->setSection(self::joinType($this->getType()) . $this->joinFilters(
        $this->getQueryString()->getFilterValue()) . self::joinParent($this->getParentId()));
    }

    private static function joinType(string $type): string {
      self::checkType($type);
      return "JOIN $type ON model.id = $type.id ";
    }

    private function joinFilters(array $filters): string {
      return array_reduce($filters, [$this, 'joinFilter'], '');
    }

    private static function joinParent(int $parentId = null): string {
      return $parentId ? 'JOIN modelLink as parentLink ON model.id = parentLink.link ' : '';
    }

    private function joinFilter(string $query, array $filter): string {
      $table = $filter['table'];
      if (!in_array($table, $this->joinedFilters)) {
        $this->joinedFilters[] = $table;
        return empty($table) ? $query : "{$query}JOIN modelLink AS {$table}Link
          ON model.id = {$table}Link.id ";
      }
      return $query;
    }

    private static function checkType(string $type) {
      if (!in_array($type, self::getTableNames())) {
        throw new QueryException('TYPE_NOT_ALLOWED');
      }
    }

  }
