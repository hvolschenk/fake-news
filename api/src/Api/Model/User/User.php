<?php
  namespace Rwdg\Api\Model\User;
  use Rwdg\Api\Model\User\Authorization\Authorization;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Connection\ConnectionInterface;
  use Rwdg\Api\Query\QueryString\QueryStringFactory;
  class User extends \Rwdg\Api\Model\ModelAbstract {

    use \Rwdg\Api\Model\User\Authentication\AuthenticationTrait;
    use \Rwdg\Api\Model\User\Authorization\AuthorizationTrait;
    use \Rwdg\Connection\ConnectionTrait;

    public $name;
    public $email;
    public $password;
    public $privileges;
    public $role;
    public $token;

    public function __construct(ConnectionInterface $connection, User $user = null) {
      parent::__construct($connection, $user);
      $this->buildAuthentication('Email', $this, $connection);
      $this->buildAuthorization('RoleBased', $this);
    }

    public function create(int $id) {
      $this->set('id', $id);
      $this->getConnection()->executeStatement(
        'CALL user_create(:id, :name, :email, :password, :role)',
        [
          'id' => $this->get('id'),
          'name' => $this->get('name'),
          'email' => $this->get('email'),
          'password' => password_hash($this->get('password'), PASSWORD_BCRYPT),
          'role' => $this->getUser()->get('role')
        ]
      );
    }

    public function update() {
      $password = $this->get('password');
      $hash = isset($password) && !empty($password) ?
        password_hash($password, PASSWORD_BCRYPT) : null;
      $this->getConnection()->executeStatement(
        'CALL user_update(:id, :name, :email, :password, :role)',
        [
          'id' => $this->get('id'),
          'name' => $this->get('name'),
          'email' => $this->get('email'),
          'password' => $hash,
          'role' => $this->get('role')
        ]
      );
    }

    public function fetchFromAuthorizationToken(string $token) {
      if (!empty($token)) {
        $user = $this->getConnection()->executeStatement('CALL user_loadFromLoginToken(:token)',
          ['token' => $token]);
        if (!empty($user)) {
          $this->setValuesFromArray(array_merge($user[0], ['token' => $token]));
        } else {
          $this->setGuestUser();
        }
      } else {
        $this->setGuestUser();
      }
    }

    public function login(string $email, string $password) {
      $user = $this->getConnection()->executeStatement('CALL user_loadFromEmailAddress(:email)',
        ['email' => $email]);
      if (empty($user)) {
        $this->addValidationError('email', 'EMAIL_ADDRESS_NOT_FOUND');
      } else {
        if (password_verify($password, $user[0]['password'])) {
          $this->setValuesFromArray($user[0]);
          $this->set('token', $this->getAuthentication()->generateToken());
        } else {
          $this->addValidationError('password', 'ERROR_PASSWORD_INVALID');
        }
      }
    }

    public function loadFromEmailAddress(string $email) {
      $user = $this->getConnection()->executeStatement('CALL user_loadFromEmailAddress(:email)',
        ['email' => $email]);
      if (empty($user)) {
        $this->addValidationError('email', 'EMAIL_ADDRESS_NOT_FOUND');
      }
      else {
        $this->setValuesFromArray($user[0]);
      }
    }

    public function logout() {
      $this->getAuthentication()->invalidateToken($this->get('token'));
      $this->set('token', null);
      $this->fetchFromAuthorizationToken($this->get('token') ?? '');
    }

    private function setGuestUser() {
      $this->setValuesFromArray([
        'id' => 0,
        'name' => 'Guest',
        'email' => 'guest@guest',
        'role' => 0
      ]);
    }

    protected function getPrivileges(): array {
      return $this->getAuthorization()->getPrivileges();
    }

    protected function setRole($role) {
      $this->role = (int)$role;
    }

  }
