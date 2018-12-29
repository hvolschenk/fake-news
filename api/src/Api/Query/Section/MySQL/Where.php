<?php
  namespace Rwdg\Api\Query\Section\MySQL;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryException;
  use Rwdg\Api\Query\QueryAbstract;
  use Rwdg\Api\Query\QueryString\QueryString;
  class Where extends \Rwdg\Api\Query\Section\SectionAbstract {

    use \Hvolschenk\Traits\Compose;

    private $className;
    private $searchValue;
    private $searchExactValue;
    private $filterValue;

    public function __construct(string $type, QueryString $queryString, ModelInterface $model,
    int $parentId = null) {
      $this->setType($type);
      $this->setQueryString($queryString);
      $this->buildClassName();
      $this->buildFilterValue();
      parent::__construct($type, $queryString, $model, $parentId);
    }

    protected function buildSection() {
      $this->setSection($this->getBeginning() . $this->getStatuses() . $this->getSearch() .
        $this->getSearchExact() . $this->getFilters() .
          $this->getIdValue($this->getModel()->getId()) . $this->getParent($this->getParentId()));
    }

    private function getBeginning(): string {
      return 'WHERE ';
    }

    private function getStatuses(): string {
      return $this->composeMixed($this->getClassName()::STATUSES[0],
        [[$this, 'buildStatuses'], ['self', 'addBrackets'],
          ['self', 'removeFirstOr']]);
    }

    private function getSearch(): string {
      $this->buildSearchValue();
      return $this->getSearchValue() === '%%' ? '' : $this->composeMixed(
        $this->getModel()->getSchema()->getFieldsSearch(),
          [[$this, 'buildSearches'], ['self', 'addBrackets'],
            ['self', 'removeFirstOr'], ['self', 'addAnd']]);
    }

    private function getSearchExact(): string {
      $this->buildSearchExactValue();
      return $this->getSearchExactValue() === '' ? '' : $this->composeMixed(
        $this->getModel()->getSchema()->getFieldsSearch(),
          [[$this, 'buildSearchesExact'], ['self', 'addBrackets'],
            ['self', 'removeFirstOr'], ['self', 'addAnd']]);
    }

    private function getFilters(): string {
      $filterValue = $this->getFilterValue();
      return empty($filterValue) ?  '' : $this->composeMixed($filterValue,
        [[$this, 'buildFilters'], ['self', 'addBrackets'],
          ['self', 'removeFirstOr'], ['self', 'addAnd']]);
    }

    private function getIdValue(int $id = null): string {
      return ($id && $id !== 0) ? 'AND model.id = ' . $this->addParameter($id) . ' ' : '';
    }

    private function getParent(int $parentId = null): string {
      return $parentId ? 'AND parentLink.id = ' . $this->addParameter($parentId) . ' ' : '';
    }

    private function buildFilters(array $filters): string {
      return array_reduce($filters, [$this, 'buildFilter'], '');
    }

    private function buildFilter(string $currentFilter, array $filter): string {
      $table = $filter['table'];
      self::checkType($table);
      return ($currentFilter === '' ? '' : "{$currentFilter}AND ") .  "{$table}Link.link = " .
        $this->addParameter($filter['value']) . ' ';
    }

    private function buildStatuses(array $statuses): string {
      return array_reduce($statuses, [$this, 'buildStatus'], '');
    }

    private function buildStatus(string $currentStatus,
    string $status): string {
      return "{$currentStatus}OR model.status = " .
        $this->addParameter($status) . ' ';
    }

    private function buildSearches(array $searches): string {
      return array_reduce($searches, [$this, 'buildSearch'], '');
    }

    private function buildSearchesExact(array $searchesExact): string {
      return array_reduce($searchesExact, [$this, 'buildSearchExact'], '');
    }

    private function buildSearch(string $currentSearch, array $field): string {
      return "{$currentSearch}OR {$field['name']} LIKE " .
        $this->addParameter($this->getSearchValue()) . ' ';
    }

    private function buildSearchExact(string $currentSearch, array $field): string {
      return "{$currentSearch}OR {$field['name']} = " .
        $this->addParameter($this->getSearchExactValue()) . ' ';
    }

    private static function addBrackets(string $group): string {
      return "($group) ";
    }

    private static function removeFirstOr(string $statuses): string {
      return str_replace('(OR ', '(', $statuses);
    }

    private static function addAnd(string $group) : string {
      return "AND {$group}";
    }

    private function setClassName(string $className) {
      $this->className = $className;
    }

    private function buildClassName() {
      $this->setClassName(ModelFactory::getClassName($this->getType()));
    }

    private function setSearchValue(string $searchValue) {
      $this->searchValue = $searchValue;
    }

    private function setSearchExactValue(string $searchExactValue) {
      $this->searchExactValue = $searchExactValue;
    }

    private function buildSearchValue() {
      $this->setSearchValue("%{$this->getQueryString()->getSearchValue()['query']}%");
    }

    private function buildSearchExactValue() {
      $this->setSearchExactValue("{$this->getQueryString()->getSearchExactValue()['query']}");
    }

    private function setFilterValue(array $filterValue) {
      $this->filterValue = $filterValue;
    }

    private function buildFilterValue() {
      $this->setFilterValue($this->getQueryString()->getFilterValue());
    }

    private function getClassName(): string {
      return $this->className ?? '';
    }

    private function getSearchValue(): string {
      return $this->searchValue;
    }

    private function getSearchExactValue(): string {
      return $this->searchExactValue;
    }

    private function getFilterValue(): array {
      return $this->filterValue ?? [];
    }

    private static function checkType(string $type) {
      if (!in_array($type, self::getTableNames())) {
        throw new QueryException('TYPE_NOT_ALLOWED');
      }
    }

  }
