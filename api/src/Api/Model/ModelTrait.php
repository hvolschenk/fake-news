<?php
  namespace Rwdg\Api\Model;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  trait ModelTrait {

    private $model;

    private function setModel(ModelInterface $model) {
      $this->model = $model;
    }

    public function getModel(): ModelInterface {
      return $this->model;
    }

    private function buildModel(string $type, ConnectionInterface $connection, User $user = null) {
      $this->setModel(ModelFactory::makeModel($type, $connection, $user));
    }

  }
