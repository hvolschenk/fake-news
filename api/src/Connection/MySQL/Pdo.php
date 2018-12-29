<?php
  namespace Rwdg\Connection\MySQL;
  class Pdo extends \Rwdg\Connection\ConnectionAbstract {

    private $preparedStatement;

    public function connect(string $host, string $username,
    string $password): bool {
      try {
        $this->buildConnection($host, $username, $password);
        $this->prepareConnection();
        return true;
      } catch(PDOException $e) {
        return false;
      }
    }

    public function selectDatabase(string $database): bool {
      return $this->getConnection()->exec("Use `$database`") === 0;
    }

    public function disconnect(): bool {
      $this->unsetConnection();
      return true;
    }

    public function executeStatement(string $query, array $parameters): array {
      // echo "$query \n";
      // echo var_dump($parameters);
      $this->prepare($query);
      $this->execute($parameters);
      return $this->fetchAll();
    }

    private function prepare(string $query) {
      $this->buildPreparedStatement($query);
    }

    private function execute(array $values): bool {
      $execute = $this->getPreparedStatement()->execute($values);
      if (!$execute) {
        // echo var_dump($this->getPreparedStatement()->errorInfo());
      }
      return $execute;
    }

    private function fetchAll(): array {
      $preparedStatement = $this->getPreparedStatement();
      $preparedStatement->setFetchMode(\PDO::FETCH_ASSOC);
      $result = $preparedStatement->fetchAll();
      $this->unsetPreparedStatement();
      return $result;
    }

    private function prepareConnection() {
      $this->getConnection()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    private static function buildHostString(string $host): string {
      return "host=$host;";
    }

    private function setConnection(\PDO $connection) {
      $this->connection = $connection;
    }

    private function getConnection(): \PDO {
      return $this->connection;
    }

    private function buildConnection(string $host, string $username, string $password) {
      $this->setConnection(new \PDO('mysql:' . self::buildHostString($host), $username, $password));
    }

    private function unsetConnection() {
      unset($this->connection);
    }

    private function setPreparedStatement(\PDOStatement $preparedStatement) {
      $this->preparedStatement = $preparedStatement;
    }

    private function getPreparedStatement(): \PDOStatement {
      return $this->preparedStatement;
    }

    private function buildPreparedStatement(string $query) {
      $this->setPreparedStatement($this->getConnection()->prepare($query));
    }

    private function unsetPreparedStatement() {
      unset($this->preparedStatement);
    }

  }
