<?php
  namespace Rwdg\Api\Query;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\Section\SectionFactory;
  use Rwdg\Api\Query\Section\SectionInterface;
  use Rwdg\Api\Query\QueryString\QueryStringInterface;
  abstract class QueryAbstract implements QueryInterface {

    use \Rwdg\Api\Model\ModelTrait;
    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    const SECTIONS = [];

    protected $type;
    protected $query;
    protected $driver;
    protected $parentId;

    private $variables = [];

    public function __construct(string $type, string $driver, QueryStringInterface $queryString,
    ModelInterface $model, int $parentId = null) {
      $this->setType($type);
      $this->setDriver($driver);
      $this->setQueryString($queryString);
      $this->setModel($model);
      $this->setParentId($parentId);
      $this->buildQuery();
    }

    public function getQuery(): string {
      return $this->query;
    }

    private function setType(string $type) {
      $this->type = $type;
    }

    private function getType(): string {
      return $this->type;
    }

    private function setDriver(string $driver) {
      $this->driver = $driver;
    }

    private function getDriver(): string {
      return $this->driver;
    }

    private function setParentId(int $parentId = null) {
      $this->parentId = $parentId;
    }

    private function getParentId() {
      return $this->parentId;
    }

    private function setQuery(string $query) {
      $this->query = $query;
    }

    private function buildQuery() {
      $this->setQuery(array_reduce(get_called_class()::SECTIONS, ['self', 'addSectionQuery'], ''));
    }

    private function addSectionQuery(string $query, string $section): string {
      $sectionObject = SectionFactory::makeSection($section, $this->getType(), $this->getDriver(),
        $this->getQueryString(), $this->getModel(), $this->getParentId());
      $this->addParameters($sectionObject);
      return $query . $sectionObject->getSection();
    }

    private function addParameters(SectionInterface $sectionObject) {
      $this->setVariables(array_merge($this->getVariables(),
        $sectionObject->getVariables()));
    }

    private function setVariables(array $variables) {
      $this->variables = $variables;
    }

    public function getVariables(): array {
      return $this->variables;
    }

  }
