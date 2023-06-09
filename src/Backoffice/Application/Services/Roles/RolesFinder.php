<?php

namespace Src\Backoffice\Application\Services\Roles;

use Src\Backoffice\Domain\Roles\IRoleRepository;

class RolesFinder
{
    private IRoleRepository $repository;

    public function __construct(IRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->matching();
    }
}