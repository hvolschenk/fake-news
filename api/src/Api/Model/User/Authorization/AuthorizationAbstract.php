<?php
  namespace Rwdg\Api\Model\User\Authorization;
  use Rwdg\Api\Model\User\User;
  abstract class AuthorizationAbstract implements AuthorizationInterface {

    use \Rwdg\Api\Model\User\UserTrait;

    public function __construct(User $user) {
      $this->setUser($user);
    }

    abstract public function getPrivileges();

    abstract public function hasPrivilege(string $type, string $action);

  }
