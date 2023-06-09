<?php

namespace Src\Backoffice\Domain\Roles;

use Src\Backoffice\Domain\Roles\Permissions\Permission;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;
use Src\Shared\Domain\IRepository;

interface IRoleRepository extends IRepository
{
    public function save(Role $role): void;

    public function findOneById(RoleId $id): IRole;

    public function findOnePermission(PermissionValue $value): Permission;

    public function matching(): array;

    public function delete(RoleId $role): void;
}