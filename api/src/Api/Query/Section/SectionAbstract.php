<?php
  namespace Rwdg\Api\Query\Section;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryString\QueryString;
  abstract class SectionAbstract implements SectionInterface {

    use \Rwdg\Api\Model\ModelTrait;
    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    protected $section;
    protected $type;
    protected $parentId;

    private $variables = [];

    public function __construct(string $type, QueryString $queryString, ModelInterface $model,
    int $parentId = null) {
      $this->setType($type);
      $this->setQueryString($queryString);
      $this->setModel($model);
      $this->setParentId($parentId);
      $this->buildSection();
    }

    public function getVariables(): array {
      return $this->variables;
    }

    abstract protected function buildSection();

    protected function setSection(string $section) {
      $this->section = $section;
    }

    public function getSection(): string {
      return $this->section;
    }

    protected function setType(string $type) {
      $this->type = lcfirst($type);
    }

    protected function getType(): string {
      return $this->type;
    }

    protected function addParameter($value): string {
      $variableKey = self::getVariableKey();
      $this->setVariableValue($variableKey, $value);
      return ":$variableKey";
    }

    private function setParentId(int $parentId = null) {
      $this->parentId = $parentId;
    }

    protected function getParentId() {
      return $this->parentId;
    }

    private function setVariableValue(string $key, $value) {
      $this->variables[$key] = $value;
    }

    private static function getVariableKey(): string {
      return md5(microtime());
    }

    protected static function getTableNames(): array {
      return array_map(['self', 'getTableName'], glob('Model/*', GLOB_NOSORT + GLOB_ONLYDIR));
    }

    private static function getTableName(string $fullName) {
      return lcfirst(explode('/', $fullName)[1]);
    }

  }
