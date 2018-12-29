<?php
  namespace Rwdg\Api\Collection;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  trait CollectionTrait {

    private $collection;

    private function setCollection(CollectionInterface $collection) {
      $this->collection = $collection;
    }

    public function getCollection(): CollectionInterface {
      return $this->collection;
    }

    private function buildCollection(string $type, ConnectionInterface $connection,
    User $user = null) {
      $this->setCollection(CollectionFactory::makeCollection($type, $connection, $user));
    }

  }
