<?php

namespace Src\Backoffice\Application\Services\Roles;

use Exception;
use Src\Backoffice\Domain\Roles\IRoleRepository;
use Src\Backoffice\Domain\Roles\RoleId;

class RoleDeleter
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RoleId $id): void
    {
        $role = $this->repository->findOneById($id);

        if (!$role->isRemovable()) {
            throw new Exception("Cannot be deleted");
        }

        $this->repository->delete($id);
    }
}