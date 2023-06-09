<?php

namespace Src\Backoffice\Application\Services\Roles;

use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\IRole;
use Src\Backoffice\Domain\Roles\RoleId;

class RoleFinder
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RoleId $id): IRole
    {
        return $this->repository->findOneById($id);
    }
}