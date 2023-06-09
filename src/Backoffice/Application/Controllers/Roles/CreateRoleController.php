<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Application\Controllers\Controller;
use Src\Backoffice\Application\Services\Roles\PermissionFinder;
use Src\Backoffice\Application\Services\Roles\RoleCreator;
use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;
use Src\Backoffice\Domain\Roles\RoleId;
use Src\Backoffice\Domain\Roles\RoleName;

final class CreateRoleController extends Controller
{
    public function __invoke(string $name, array $permissions): void
    {
        $roleCreator      = new RoleCreator($this->repository);
        $permissionFinder = new PermissionFinder($this->repository);

        $permissions = array_map(function (string $permission) use ($permissionFinder) {
            return $permissionFinder->__invoke(new PermissionValue($permission));
        }, $permissions);

        $roleCreator->__invoke(new RoleId(), new RoleName($name), new PermissionGroup($permissions));
    }
}
