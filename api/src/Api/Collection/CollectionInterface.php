<?php
  namespace Rwdg\Api\Collection;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Query\QueryInterface;
  use Rwdg\Connection\ConnectionInterface;
  interface CollectionInterface {

    public function __construct(ConnectionInterface $connection, User $user = null);

    public function fetch(QueryInterface $query);

  }
