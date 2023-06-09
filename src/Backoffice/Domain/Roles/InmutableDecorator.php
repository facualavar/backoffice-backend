<?php

namespace Src\Backoffice\Domain\Roles;

use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;

class InmutableDecorator extends RoleDecorator implements IRole
{
    public function updatePermissions(PermissionGroup $permissions): void
    {
    }

    public function addPermission(PermissionName $permissionName, PermissionValue $permissionValue): void
    {
    }

    public function removePermission(PermissionValue $permissionValue): void
    {
    }

    public function isRemovable(): bool
    {
        return false;
    }

    public function isModifiable(): bool
    {
        return false;
    }
}