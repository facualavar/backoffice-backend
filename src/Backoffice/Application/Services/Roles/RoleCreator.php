<?php

namespace Src\Backoffice\Application\Services\Roles;

use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Role;
use Src\Backoffice\Domain\Roles\RoleId;
use Src\Backoffice\Domain\Roles\RoleName;

class RoleCreator
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RoleId $id, RoleName $name, PermissionGroup $permissions): void
    {
        $role = new Role($id, $name, $permissions);

        $this->repository->save($role);
    }
}