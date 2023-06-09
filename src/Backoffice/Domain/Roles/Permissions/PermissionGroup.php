<?php

namespace Src\Backoffice\Domain\Roles\Permissions;

use Src\Shared\Domain\Collection;

class PermissionGroup
{
    private Collection $permissions;

    public function __construct(array $permissions)
    {
        $this->permissions = new Collection(Permission::class);
        $this->permissions->setItems($permissions);
    }

    public function getPermissions(): array
    {
        return $this->permissions->getIterator()->getArrayCopy();
    }

    public function add(PermissionName $permissionName, PermissionValue $permissionValue): void
    {
        $permissions = $this->getPermissions();
        $permissions[] = new Permission($permissionName, $permissionValue);
        $this->permissions->setItems($permissions);
    }

    public function find(PermissionValue $permissionValue): bool
    {
        return array_reduce($this->getPermissions(), function (bool $located, $permission) use ($permissionValue) {
            return $located || $permission->getValue()->value() === $permissionValue;
        }, false);
    }

    public function remove(PermissionValue $permissionValue): void
    {
        $permissions = array_filter($this->getPermissions(), function (Permission $permission) use ($permissionValue) {
            return $permission->getValue()->value() !== $permissionValue;
        });

        $this->permissions->setItems($permissions);
    }
}