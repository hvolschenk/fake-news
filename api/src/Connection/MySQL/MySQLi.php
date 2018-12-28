<?php
  namespace Rwdg\Connection\MySQL;
  class MySQLi extends \Rwdg\Connection\ConnectionAbstract {

    public function connect(string $host, string $username,
    string $password): bool {
      $this->buildConnection($host, $username, $password);
      return !(bool)$this->getConnection()->connect_errno;
    }

    public function selectDatabase(string $database): bool {
      return $this->getConnection()->select_db($database);
    }

    public function disconnect(): bool {
      return $this->getConnection()->close();
    }

    public function executeStatement(string $query, array $parameters): array {}

    private function setConnection(\mysqli $connection) {
      $this->connection = $connection;
    }

    private function getConnection(): \mysqli {
      return $this->connection;
    }

    private function buildConnection(string $host, string $username, string $password) {
      $this->setConnection(new \mysqli($host, $username, $password));
    }

  }
