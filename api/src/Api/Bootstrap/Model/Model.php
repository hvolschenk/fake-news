<?php
  namespace Rwdg\Api\Bootstrap\Model;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  class Model {

    use \Rwdg\Api\Model\ModelTrait;

    public function __construct(string $type, ConnectionInterface $connection, User $user = null) {
      $this->buildModel($type, $connection, $user);
    }

  }
