<?php

namespace Src\Backoffice\Application\Controllers\Roles;

use Src\Backoffice\Application\Controllers\Controller;
use Src\Backoffice\Application\Services\Roles\RoleDeleter;
use Src\Backoffice\Domain\Roles\RoleId;

class DeleteRoleController extends Controller
{
    public function __invoke(string $id): void
    {
        $deleter = new RoleDeleter($this->repository);

        $deleter->__invoke(new RoleId($id));
    }
}