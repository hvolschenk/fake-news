<?php
  namespace Rwdg\Api\Model\User\Authorization\RoleBased;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  class RoleBased extends \Rwdg\Api\Model\User\Authorization\AuthorizationAbstract {

    private $map;
    private $role;

    public function __construct(User $user) {
      parent::__construct($user);
      $this->buildMap();
    }

    public function getPrivileges(): array {
      return array_map([$this, 'getRoleTypePrivileges'], $this->getMap());
    }

    public function hasPrivilege(string $type, string $action): bool {
      return in_array(
        $action,
        $this->getPrivileges()[$type] ?? []
      );
    }

    private function getRoleTypePrivileges(array $typePrivileges): array {
      return array_keys($this->filterRoleTypePrivileges($typePrivileges));
    }

    private function filterRoleTypePrivileges(array $typePrivileges): array {
      return array_filter($typePrivileges, [$this, 'getTypeActionPrivileges']);
    }

    private function getTypeActionPrivileges(array $action) {
      return in_array($this->getUser()->get('role') ?? 0, $action[0]);
    }

    private function setMap(array $map) {
      $this->map = $map;
    }

    private function getMap(): array {
      return $this->map ?? [];
    }

    private function buildMap() {
      $this->setMap(self::parseMap(self::readMapFile()));
    }

    private static function readMapFile(): string {
      return file_get_contents(dirname(__FILE__) . '/map.json');
    }

    private static function parseMap(string $map): array {
      return json_decode($map, true);
    }

  }
