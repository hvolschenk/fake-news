<?php
  namespace Rwdg\Api\Bootstrap\Connection;
  use Rwdg\Api\Bootstrap\BootstrapException;
  use Rwdg\Connection\ConnectionInterface;
  class Connection {

    use \Rwdg\Connection\ConnectionTrait;

    public function __construct(string $host, string $username,
    string $password, string $database, string $driver, string $api) {
      $this->buildConnection($driver, $api);
      $this->connect($host, $username, $password);
      $this->selectDatabase($database);
    }

    private function connect(string $host, string $username, string $password) {
      if ($this->getConnection()->connect($host, $username, $password) === false) {
        $this->throwException();
      }
    }

    private function selectDatabase(string $database) {
      if ($this->getConnection()->selectDatabase($database) === false) {
        $this->throwException();
      }
    }

    private function throwException() {
      throw new BootstrapException('BOOTSTRAP_CONNECTION_FAILED');
    }

  }
