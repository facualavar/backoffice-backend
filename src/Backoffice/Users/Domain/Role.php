<?php

namespace Src\Backoffice\Users\Domain;

use Src\Shared\Domain\Entity;

class Role extends Entity
{
    private string $name;
    private array $permissions;

    public function __construct(string $name, array $permissions)
    {
        $this->id          = new RoleId();
        $this->name        = $name;
        $this->permissions = $permissions;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function hasPermission(Permission $searchedPermission): bool
    {
        return array_reduce($this->permissions, function (bool $located, $permission) use ($searchedPermission) {
            return $located || $permission->getValue() === $searchedPermission->getValue();
        }, false);
    }

    public function addPermission(Permission $permission): void
    {
        $this->permissions[] = $permission;
    }

    public function removePermission(Permission $permissionToRemove): void
    {
        $this->permissions = array_filter($this->permissions, function (Permission $permission) use ($permissionToRemove) {
            return $permissionToRemove->getValue() !== $permission->getValue();
        });
    }
}