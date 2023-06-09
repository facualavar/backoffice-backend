<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Application\Controllers\Controller;
use Src\Backoffice\Application\Services\Roles\RoleFinder;
use Src\Backoffice\Domain\Roles\RoleId;

class FindRoleController extends Controller
{
    public function __invoke(string $id): RoleDTO
    {
        $finder = new RoleFinder($this->repository);

        $role = $finder->__invoke(new RoleId($id));

        return new RoleDTO($role);
    }
}