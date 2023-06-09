<?php

namespace Src\Backoffice\Domain\Roles;

use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;
use Src\Shared\Domain\Agregate\IAgregateRoot;
use Src\Shared\Domain\Entity;

class Role extends Entity implements IAgregateRoot, IRole
{
    protected RoleName $name;
    protected PermissionGroup $permissionGroup;

    public function __construct(RoleId $roleId, RoleName $name, PermissionGroup $permissions)
    {
        $this->id              = $roleId;
        $this->name            = $name;
        $this->permissionGroup = $permissions;
    }

    public function getName(): RoleName
    {
        return $this->name;
    }

    public function updateName(RoleName $newName): void
    {
        $this->name = $newName;
    }

    public function getPermissions(): array
    {
        return $this->permissionGroup->getPermissions();
    }

    public function hasPermission(PermissionValue $permissionValue): bool
    {
        return $this->permissionGroup->find($permissionValue);
    }

    public function updatePermissions(PermissionGroup $permissions): void
    {
        $this->permissionGroup = $permissions;
    }

    public function addPermission(PermissionName $permissionName, PermissionValue $permissionValue): void
    {
        $this->permissionGroup->add($permissionName, $permissionValue);
    }

    public function removePermission(PermissionValue $permissionValue): void
    {
        $this->permissionGroup->remove($permissionValue);
    }

    public function isRemovable(): bool
    {
        return true;
    }

    public function isModifiable(): bool
    {
        return true;
    }
}