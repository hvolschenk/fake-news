<?php
  namespace Rwdg\Api\Bootstrap\Collection;
  use Rwdg\Connection\ConnectionInterface;
  use Rwdg\Api\Collection\CollectionFactory;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\User\User;
  class Collection {

    use \Rwdg\Api\Collection\CollectionTrait;

    private $type;

    public function __construct(string $type, ConnectionInterface $connection, User $user) {
      $this->setType($type);
      $this->buildCollection($this->getType(), $connection, $user);
    }

    private function setType(string $type) {
      $this->type = $type;
    }

    private function getType(): string {
      return $this->type;
    }

  }
