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

    public $role;
    public $sessionId;

    public function __construct(ConnectionInterface $connection, User $user = null) {
      parent::__construct($connection, $user);
      $this->buildAuthentication('Email', $this, $connection);
      $this->buildAuthorization('RoleBased', $this);
    }

    public function create(int $id) {
      $this->set('id', $id);
      $this->getConnection()->executeStatement(
        'CALL user_create(:id, :sessionId, :role)',
        [
          'id' => $this->get('id'),
          'sessionId' => $this->get('sessionId'),
          'role' => $this->get('role')
        ]
      );
    }

    public function fetchFromSessionId(string $sessionId) {
      $user = $this->getConnection()->executeStatement(
        'CALL user_fromSessionId(:sessionId)',
        ['sessionId' => $sessionId]
      );
      if (!empty($user)) {
        $this->setValuesFromArray(array_merge($user[0], ['sessionId' => $sessionId]));
      } else {
        $this->set('sessionId', $sessionId);
        $this->set('role', 0);
        $this->create($this->createId(0));
        $this->assignToRandomPool();
        $this->fetchFromSessionId($sessionId);
      }
    }

    private function assignToRandomPool() {
      $pool = $this->getConnection()->executeStatement('CALL pool_random()', []);
      if (!empty($pool)) {
        $this->addLink($pool[0]['id']);
      }
    }

    private function buildQuestionValues() {

    }

    private function setGuestUser() {
      $this->setValuesFromArray([
        'id' => 0,
        'sessionId' => 0,
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
