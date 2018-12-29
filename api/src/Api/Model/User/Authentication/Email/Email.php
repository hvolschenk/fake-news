<?php
  namespace Rwdg\Api\Model\User\Authentication\Email;
  class Email extends \Rwdg\Api\Model\User\Authentication\AuthenticationAbstract {

    public function generateToken(): string {
      $token = md5(microtime());
      return $this->saveToken($token) ? $token : '';
    }

    public function invalidateToken(string $token): bool {
      return empty($this->getConnection()->executeStatement(
        'CALL user_invalidateUserToken(:token)', ['token' => $token]));
    }

    private function saveToken(string $token): bool {
      return empty($this->getConnection()->executeStatement(
        'CALL user_createLoginToken(:userId, :token)',
          ['userId' => $this->getUser()->get('id'), 'token' => $token]));
    }

    private function invalidateTokens(int $userId): bool {
      return empty($this->getConnection()->executeStatement(
        'CALL user_invalidateAllUserTokens(:userId)', ['userId' => $userId]));
    }

  }
