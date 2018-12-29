<?php
  namespace Rwdg\Api\Model\User\Authentication;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  interface AuthenticationInterface {

    public function __construct(User $user, ConnectionInterface $connection);

    public function generateToken(): string;

    public function invalidateToken(string $token): bool;

  }
