<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Src\Backoffice\Application\Roles\Create\CreateRoleCommand;
use Src\Backoffice\Application\Roles\Create\RoleCreator;
use Src\Backoffice\Infrastructure\Roles\Eloquent\EloquentRoleRepository;

class Controller extends BaseController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new EloquentRoleRepository();
    }

    public function create(): void
    {
        $creator = new RoleCreator($this->repository);

        $crearRol = new CreateRoleCommand($creator);

        $permissions = [
            [
                'value' => 'roles_read',
                'name' => 'Listar Roles',
            ],
            [
                'value' => 'roles_update',
                'name' => 'Modificar Roles',
            ],
        ];
        $crearRol->__invoke("Admin", $permissions);
    }
}
