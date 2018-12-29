<?php
  namespace Rwdg\Connection;
  abstract class ConnectionAbstract implements ConnectionInterface {

    private $connection = null;

    abstract public function connect(string $host, string $username,
      string $password): bool;

    abstract public function selectDatabase(string $database): bool;

    abstract public function disconnect(): bool;

    abstract public function executeStatement(string $query, array $parameters): array;

  }
