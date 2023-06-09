<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Application\Controllers\Controller;
use Src\Backoffice\Application\Services\Roles\RolesFinder;

class ListRolesController extends Controller
{
    public function __invoke(): array
    {
        $finder = new RolesFinder($this->repository);

        $roles = $finder->__invoke();

        return array_map(function ($role) {
            return new RoleDTO($role);
        }, $roles);
    }
}