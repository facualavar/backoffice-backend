<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Domain\Roles\Permissions\Permission;

class PermissionDTO
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function serialize(): array
    {
        return [
            'value' => $this->permission->getValue()->value(),
            'name'  => $this->permission->getName()->value(),
        ];
    }
}