<?php
  namespace Rwdg\Api\Model\User\Authorization;
  interface AuthorizationInterface {

    public function getPrivileges();

    public function hasPrivilege(string $type, string $action);

  }
