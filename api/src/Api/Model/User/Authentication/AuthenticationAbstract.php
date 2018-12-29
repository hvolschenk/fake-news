<?php
  namespace Rwdg\Api\Model\User\Authentication;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  abstract class AuthenticationAbstract implements AuthenticationInterface {

    use \Rwdg\Api\Model\User\UserTrait;
    use \Rwdg\Connection\ConnectionTrait;

    public function __construct(User $user, ConnectionInterface $connection) {
      $this->setUser($user);
      $this->setConnection($connection);
    }

    abstract function generateToken(): string;

    abstract public function invalidateToken(string $token): bool;

  }
