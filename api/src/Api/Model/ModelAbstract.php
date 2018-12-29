<?php
  namespace Rwdg\Api\Model;
  use Rwdg\Api\Model\Validation\ValidationAbstract;
  use Rwdg\Api\Collection\CollectionFactory;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Query\QueryFactory;
  use Rwdg\Api\Query\QueryInterface;
  use Rwdg\Api\Query\QueryString\QueryString;
  use Rwdg\Api\Query\QueryString\QueryStringFactory;
  use Rwdg\Config\Connection as Config;
  use Rwdg\Connection\ConnectionInterface;
  abstract class ModelAbstract implements ModelInterface {

    use \Rwdg\Api\Model\SchemaTrait;
    use \Rwdg\Api\Model\User\UserTrait;
    use \Rwdg\Api\Model\Validation\ValidationTrait;
    use \Rwdg\Connection\ConnectionTrait;

    const STATUSES = [['A'], ['A'], ['A'], ['A'], ['A']];

    public $id;
    public $type;
    public $dateCreated;
    public $dateModified;
    public $status;
    public $createdBy;
    public $validationErrors;
    public $error;
    public $branch;

    private $links = [];
    private $parentLinks = [];

    public function __construct(ConnectionInterface $connection, User $user = null) {
      $this->setConnection($connection);
      if ($user !== null) {
        $this->setUser($user);
      }
      $this->buildSchema($this->getClassName());
    }

    public function fetch(QueryInterface $query) {
      $queryResult = $this->getConnection()->executeStatement($query->getQuery(),
        $query->getVariables());
      $this->setValuesFromArray($queryResult ? $queryResult[0] : []);
    }

    public function asArray(): array {
      return array_merge(
        $this->asArrayFields(),
        $this->asArrayLinks(),
        $this->asArrayParentLinks()
      );
    }

    public function validate(array $fields = null) {
      $this->buildValidation($this->getClassName(), $this);
      $this->setValidationErrors($this->getValidation()->validate($fields));
    }

    public function create(int $id) {
      $this->getConnection()->executeStatement($this->buildCreateStatement(),
        $this->buildCreateStatementValues());
    }

    public function update() {
      $this->getConnection()->executeStatement($this->buildUpdateStatement(),
        $this->buildUpdateStatementValues());
      $this->updateDateModified();
    }

    public function delete() {
      $this->getConnection()->executeStatement('CALL model_delete(:id)',
        ['id' => $this->get('id')]);
      $this->updateDateModified();
    }

    private function updateDateModified() {
      $this->getConnection()->executeStatement('CALL model_updateDateModified(:id)',
        ['id' => $this->get('id')]);
    }

    public function createId(int $createdBy): int {
      $newId = $this->getConnection()->executeStatement('CALL model_create(:type, :createdBy)',
        ['type' => lcfirst($this->getClassName()), 'createdBy' => $createdBy]);
      $newId = (int)$newId[0]['LAST_INSERT_ID()'];
      $this->set('id', $newId);
      return $newId;
    }

    private function buildCreateStatement(): string {
      $name = lcfirst($this->getClassName());
      $parameters = $this->buildCreateStatementParameters();
      return "CALL {$name}_create({$parameters})";
    }

    private function buildUpdateStatement(): string {
      $name = lcfirst($this->getClassName());
      $parameters = $this->buildCreateStatementParameters();
      return "CALL {$name}_update({$parameters})";
    }

    private function buildCreateStatementParameters(): string {
      return implode(array_map(function(array $createField): string {
        return ":{$createField['name']}";
      }, $this->getSchema()->getFieldsCreate()), ',');
    }

    private function buildUpdateStatementParameters(): string {
      return implode(array_map(function(array $createField): string {
        return ":{$createField['name']}";
      }, $this->getSchema()->getFieldsUpdate()), ',');
    }

    private function buildCreateStatementValues(): array {
      return array_reduce($this->getSchema()->getFieldsCreate(),
        function(array $accumulator, array $createField): array {
          $name = $createField['name'];
          $accumulator[$name] = $this->get($name);
          return $accumulator;
        }, []);
    }

    private function buildUpdateStatementValues(): array {
      return array_reduce($this->getSchema()->getFieldsUpdate(),
        function(array $accumulator, array $createField): array {
          $name = $createField['name'];
          $accumulator[$name] = $this->get($name);
          return $accumulator;
        }, []);
    }

    private function asArrayFields(): array {
      $fields = $this->getSchema()->getFieldsDisplay();
      return array_map([$this, 'get'], array_combine($fields, $fields));
    }

    private function asArrayLinks(): array {
      return array_map(['self', 'linkAsArray'], $this->getLinks());
    }

    private function linkAsArray(CollectionInterface $link): array {
      return $link->asArray();
    }

    private function asArrayParentLinks(): array {
      return array_map(['self', 'parentLinkAsArray'], $this->getParentLinks());
    }

    private function parentLinkAsArray(ModelInterface $link): array {
      return $link->asArray();
    }

    public function addLinks(array $ids) {
      foreach ($ids as $id) {
        $this->addLink($id);
      }
    }

    public function addLink(int $link) {
      $this->getConnection()->executeStatement('CALL modelLink_create(:id, :link)',
        ['id' => $this->get('id'), 'link' => $link]);
    }

    public function removeLinks(string $type) {
      $this->getConnection()->executeStatement('CALL modelLink_removeType(:id, :type)',
        ['id' => $this->get('id'), 'type' => $type]);
    }

    public function fetchParents(string $type) {
      $parentIds = $this->getConnection()->executeStatement(
        'CALL model_getParentLinkIds(:id, :type)',
        ['id' => $this->get('id'), 'type' => $type]
      );
      if (isset($parentIds[0]) && is_array($parentIds[0]) && isset($parentIds[0]['id'])) {
        $queryString = QueryStringFactory::makeQueryString(['id' => $parentIds[0]['id']]);
        $model = ModelFactory::makeModel($type, $this->getConnection(), $this->getUser());
        $model->set('id', $parentIds[0]['id']);
        $query = QueryFactory::makeQuery($type, Config::DRIVER, $queryString, $model);
        $model->fetch($query);
        $this->setLinkParent("{$type}Parent", $model);
      }
    }

    public function fetchLinks(QueryString $queryString) {
      foreach ($queryString->getLinksValue() as $type=>$typeQueryString) {
        $this->fetchLink($type, $typeQueryString);
      }
    }

    public function setValidationErrors(array $validationErrors) {
      $this->validationErrors = $validationErrors;
    }

    public function getValidationErrors(): array {
      return $this->validationErrors ?? [];
    }

    public function hasErrors(): bool {
      return strlen(array_reduce($this->getValidationErrors(), ['self', 'addErrorValue'])) > 0
        && empty($this->get('error'));
    }

    private static function addErrorValue($accumulator, $value) {
      return $accumulator . $value;
    }

    protected function addValidationError($key, $error) {
      $this->setValidationErrors(array_merge($this->getValidationErrors(), [$key => $error]));
    }

    public function setError(string $error) {
      $this->error = $error;
    }

    private function fetchLink(string $type, QueryString $queryString) {
      $this->setLink($type, $this->fetchLinkCollection($type, $queryString));
    }

    private function getLinkCollectionQuery(string $type,
    QueryString $queryString): QueryInterface {
      return QueryFactory::makeQuery($type, \Rwdg\Config\Connection::DRIVER, $queryString,
        ModelFactory::makeModel($type, $this->getConnection()), $this->getId());
    }

    private function fetchLinkCollection(string $type,
    QueryString $queryString): CollectionInterface {
      $collection = $this->buildLinkCollection($type);
      $collection->fetch($this->getLinkCollectionQuery($type, $queryString));
      return $collection;
    }

    private function buildLinkCollection(string $type): CollectionInterface {
      return CollectionFactory::makeCollection(self::getTypeName($type),
        $this->getConnection(), ($this->user !== null ? $this->getUser() : null));
    }

    private static function getTypeName(string $type): string {
      return ucfirst($type);
    }

    public function setValuesFromArray(array $values = []) {
      foreach ($values as $key=>$value) {
        $this->set($key, $value);
      }
    }

    public function set(string $key, $value) {
      if (!$this->setWithSetMethod($key, $value)) {
        $this->$key = $value;
      }
    }

    public function get(string $key) {
      return $this->getWithGetMethod($key);
    }

    private function setWithSetMethod(string $key, $value): bool {
      $setMethodName = self::getSetMethodName($key);
      $methodExists = method_exists($this, $setMethodName);
      if ($methodExists) {
        $this->$setMethodName($value);
      }
      return $methodExists;
    }

    private function getWithGetMethod(string $key) {
      $getMethodName = self::getGetMethodName($key);
      $methodExists = method_exists($this, $getMethodName);
      if ($methodExists) {
        return $this->$getMethodName($key);
      }
      return $this->$key;
    }

    private static function getSetMethodName(string $key): string {
      return 'set' . ucfirst($key);
    }

    private static function getGetMethodName(string $key): string {
      return 'get' . ucfirst($key);
    }

    public function setId(int $id) {
      $this->id = $id;
    }

    public function getId(): int {
      return $this->id ?? 0;
    }

    protected function setLink($type, CollectionInterface $collection) {
      $this->links[lcfirst($type)] = $collection;
    }

    protected function setLinkParent($type, ModelInterface $model) {
      $this->parentLinks[lcfirst($type)] = $model;
    }

    public function getLinks(): array {
      return $this->links;
    }

    public function getParentLinks(): array {
      return $this->parentLinks;
    }

    private function getClassName(): string {
      return array_slice(explode('\\', get_class($this)), -1)[0];
    }

  }
