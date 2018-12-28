<?php
  namespace Rwdg\Connection;
  use Rwdg\Connection\ConnectionFactory;
  trait ConnectionTrait {

    protected $connection;

    private function setConnection(ConnectionInterface $connection) {
      $this->connection = $connection;
    }

    public function getConnection(): ConnectionInterface {
      return $this->connection;
    }

    private function buildConnection(string $driver, string $api) {
      $this->setConnection(ConnectionFactory::makeConnection($driver, $api));
    }

  }
