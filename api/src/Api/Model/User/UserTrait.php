<?php
  namespace Rwdg\Api\Model\User;
  trait UserTrait {

    protected $user;

    protected function setUser(User $user) {
      $this->user = $user;
    }

    protected function getUser(): User {
      return $this->user;
    }

  }
