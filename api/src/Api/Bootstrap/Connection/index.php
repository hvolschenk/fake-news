<?php
  namespace Rwdg\Api\Bootstrap\Connection;
  use Rwdg\Config\Connection as Config;

  $connectionBootstrap = new Connection(Config::HOST, Config::USERNAME,
    Config::PASSWORD, Config::DATABASE, Config::DRIVER, Config::API);
  $connection = $connectionBootstrap->getConnection();
  unset($connectionBootstrap);
