<?php

namespace Src\Backoffice\Application\Services\Roles;

use Exception;
use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\RoleId;
use Src\Backoffice\Domain\Roles\RoleName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;

class RoleUpdater
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RoleId $id, RoleName $name, PermissionGroup $permissionGroup): void
    {
        $role = $this->repository->findOneById($id);

        if (!$role->isModifiable()) {
            throw new Exception("Cannot be updated");
        }

        $role->updateName($name);
        $role->updatePermissions($permissionGroup);

        $this->repository->save($role);
    }
}
