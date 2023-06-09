<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Application\Controllers\Controller;
use Src\Backoffice\Application\Services\Roles\RoleUpdater;
use Src\Backoffice\Application\Services\Roles\PermissionFinder;
use Src\Backoffice\Domain\Roles\RoleId;
use Src\Backoffice\Domain\Roles\RoleName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;

class UpdateRoleController extends Controller
{
    public function __invoke(string $id, string $name, array $permissions): void
    {
        $roleUpdater      = new RoleUpdater($this->repository);
        $permissionFinder = new PermissionFinder($this->repository);

        $permissions = array_map(function (string $permission) use ($permissionFinder) {
            return $permissionFinder->__invoke(new PermissionValue($permission));
        }, $permissions);

        $roleUpdater->__invoke(new RoleId($id), new RoleName($name), new PermissionGroup($permissions));
    }
}
