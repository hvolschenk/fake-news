<?php
  namespace Rwdg\Api\Model\User\Authorization;
  use Rwdg\Api\Model\User\User;
  trait AuthorizationTrait {

    private $authorization;

    private function setAuthorization(AuthorizationInterface $authorization) {
      $this->authorization = $authorization;
    }

    public function getAuthorization(): AuthorizationInterface {
      return $this->authorization;
    }

    private function buildAuthorization(string $type, User $user) {
      $this->setAuthorization(AuthorizationFactory::makeAuthorization($type, $user));
    }

  }
