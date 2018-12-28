<?php
  namespace Rwdg\Api\Collection;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Query\QueryInterface;
  use Rwdg\Connection\ConnectionInterface;
  abstract class CollectionAbstract implements CollectionInterface {

    use \Rwdg\Api\Model\User\UserTrait;
    use \Rwdg\Connection\ConnectionTrait;
    use \Rwdg\Api\Query\QueryTrait;

    private $models;

    public function __construct(ConnectionInterface $connection, User $user = null) {
      $this->setConnection($connection);
      if ($user) {
        $this->setUser($user);
      }
    }

    public function fetch(QueryInterface $query, bool $variants = false) {
      $this->setQuery($query);
      $queryResult = $this->getConnection()->executeStatement($query->getQuery(),
        $query->getVariables());
      $this->buildModels($queryResult, $variants);
    }

    public function getModels(): array {
      return $this->models ?? [];
    }

    public function asArray(): array {
      return array_map(['self', 'modelAsArray'], $this->getModels());
    }

    private static function modelAsArray(ModelInterface $model): array {
      return $model->asArray();
    }

    private function setModels(array $models) {
      $this->models = $models;
    }

    private function buildModels(array $models, bool $variants = false) {
      $this->setModels(array_map([$this, 'buildModel'], $models, array_fill(0, count($models), $variants)));
    }

    private function buildModel(array $model, bool $variants = false): ModelInterface {
      $newModel = ModelFactory::makeModel($model['type'], $this->getConnection(),
        ($this->user !== null ? $this->getUser() : null));
      $newModel->setValuesFromArray($model);
      $newModel->fetchLinks($this->getQuery()->getQueryString(), $variants);
      return $newModel;
    }

  }
