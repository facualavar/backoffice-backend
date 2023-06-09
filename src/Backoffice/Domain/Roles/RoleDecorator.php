<?php

namespace Src\Backoffice\Domain\Roles;

use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;

abstract class RoleDecorator implements IRole
{
    protected IRole $role;

    public function __construct(IRole $role)
    {
        $this->role = $role;
    }

    public function getId(): RoleId
    {
        return $this->role->getId();
    }

    public function getName(): RoleName
    {
        return $this->role->getName();
    }

    public function updateName(RoleName $newName): void
    {
        $this->role->name = $newName;
    }

    public function getPermissions(): array
    {
        return $this->role->getPermissions();
    }

    public function hasPermission(PermissionValue $permissionValue): bool
    {
        return $this->role->hasPermission($permissionValue);
    }
}