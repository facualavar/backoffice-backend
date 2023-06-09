<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Domain\Roles\Permissions\Permission;
use Src\Backoffice\Domain\Roles\IRole;

class RoleDTO
{
    private $role;

    public function __construct(IRole $role)
    {
        $this->role = $role;
    }

    public function serialize(): array
    {
        return [
            'id'           => $this->role->getId()->getValue(),
            'name'         => $this->role->getName()->value(),
            'permisssions' => $this->serializePermissions($this->role->getPermissions()),
        ];
    }

    private function serializePermissions(array $permissions): array
    {
        return array_map(function (Permission $permission) {
            return (new PermissionDTO($permission))->serialize();
        }, $permissions);
    }
}