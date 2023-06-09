<?php

namespace Src\Backoffice\Application\Services\Permissions;

use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\Permissions\Permission;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;

class PermissionFinder
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PermissionValue $value): Permission
    {
        return $this->repository->findOnePermission($value);
    }
}