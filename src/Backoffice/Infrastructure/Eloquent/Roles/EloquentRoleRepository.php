<?php

namespace Src\Backoffice\Infrastructure\Eloquent\Roles;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Src\Backoffice\Domain\Roles\InmutableDecorator;
use Src\Backoffice\Domain\Roles\IRole;
use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\Permissions\Permission;
use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;
use Src\Backoffice\Domain\Roles\Role;
use Src\Backoffice\Domain\Roles\RoleId;
use Src\Backoffice\Domain\Roles\RoleName;

class EloquentRoleRepository implements IRoleRepository
{
    public function save(Role $role): void
    {
        $model = EloquentRole::where('id', $role->getId()->getValue())->first();

        if (!$model) {
            $model            = new EloquentRole();
            $model->id        = $role->getId();
            $model->inmutable = false;
        }

        $model->name = $role->getName()->value();
        $model->save();

        $permissionsModel = [];
        foreach ($role->getPermissions() as $permission) {
            $permissionsModel[] = [
                'role_id'          => $role->getId()->getValue(),
                'permission_value' => $permission->getValue()->value(),
            ];
        }

        $model->permissions()->sync($permissionsModel);

        $model->save();
    }

    public function findOneById(RoleId $id): IRole
    {
        $model = EloquentRole::find($id);

        $permissions = $this->permissionModelsParsePermissionArray($model->permissions);

        $role = new Role(new RoleId($model->id), new RoleName($model->name), new PermissionGroup($permissions));

        if ($model->inmutable) {
            $role = new InmutableDecorator($role);
        }

        return $role;
    }

    public function findOnePermission(PermissionValue $value): Permission
    {
        $model = EloquentPermission::find($value->value());

        return new Permission(
            new PermissionName($model->name),
            new PermissionValue($model->value),
        );
    }

    public function matching(): array
    {
        $models = EloquentRole::with('permissions')->get();

        $roles = [];
        foreach ($models as $model) {
            $permissions = $this->permissionModelsParsePermissionArray($model->permissions);

            $roles[] = new Role(
                new RoleId($model->id),
                new RoleName($model->name),
                new PermissionGroup($permissions),
            );
        }

        return $roles;
    }

    private function permissionModelsParsePermissionArray(Collection $permissionModels): array
    {
        return array_map(function ($permissionModel) {
            return new Permission(
                new PermissionName($permissionModel['name']),
                new PermissionValue($permissionModel['value']));
        }, $permissionModels->toArray());
    }

    public function delete(RoleId $id): void
    {
        $model = EloquentRole::find($id);
        $model->permissions()->detach();
        $model->delete();
    }
}
