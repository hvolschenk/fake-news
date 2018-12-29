<?php
  namespace Rwdg\Api\Model\User\Authentication;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  trait AuthenticationTrait {

    private $authentication;

    protected function setAuthentication(AuthenticationInterface $authentication) {
      $this->authentication = $authentication;
    }

    protected function getAuthentication(): AuthenticationInterface {
      return $this->authentication;
    }

    private function buildAuthentication(string $type, User $user,
    ConnectionInterface $connection) {
      $this->setAuthentication(AuthenticationFactory::makeAuthentication($type, $user,
        $connection));
    }

  }
