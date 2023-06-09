<?php

namespace Src\Backoffice\Domain\Roles\Permissions;

use Src\Shared\Domain\IRepository;

interface IPermissionRepository extends IRepository
{
    public function findOne(PermissionValue $value): Permission;

    public function create(Permission $permission): void;
}
