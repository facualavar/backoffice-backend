<?php

namespace Src\Backoffice\Infrastructure\Eloquent\Roles;

use Src\Backoffice\Domain\Roles\Permissions\IPermissionRepository;
use Src\Backoffice\Domain\Roles\Permissions\Permission;
use Src\Backoffice\Domain\Roles\Permissions\PermissionName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;

class EloquentPermissionRepository implements IPermissionRepository
{
    public function findOne(PermissionValue $value): Permission
    {
        $model = EloquentPermission::find($value);

        return new Permission(
            new PermissionName($model->name),
            new PermissionValue($model->id),
        );
    }

    public function create(Permission $permission): void
    {
        EloquentPermission::create([
            'value' => $permission->getValue()->value(),
            'name'  => $permission->getName()->value(),
        ]);
    }
}
