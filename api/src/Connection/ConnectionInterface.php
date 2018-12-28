<?php
  namespace Rwdg\Connection;
  interface ConnectionInterface {

    public function connect(string $host, string $username,
      string $password): bool;

    public function selectDatabase(string $database): bool;

    public function disconnect(): bool;

    public function executeStatement(string $query, array $parameters): array;

  }
