<?php

namespace Src\Backoffice\Infrastructure\Routing;

use Exception;
use Illuminate\Http\Request;
use Src\Backoffice\Application\Controllers\Roles\CreateRoleController;
use Src\Backoffice\Application\Controllers\Roles\DeleteRoleController;
use Src\Backoffice\Application\Controllers\Roles\FindRoleController;
use Src\Backoffice\Application\Controllers\Roles\ListRolesController;
use Src\Backoffice\Application\Controllers\Roles\UpdateRoleController;
use Src\Backoffice\Infrastructure\Eloquent\Roles\EloquentRoleRepository;
use Src\Shared\Infrastructure\ExternalInterfaces\ApiController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LaravelRoutingRoleController extends ApiController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new EloquentRoleRepository();
    }

    public function index()
    {
        try {
            $listRolesController = new ListRolesController($this->repository);
            $rolesDTos           = $listRolesController->__invoke();

            $response = array_map(function ($roleDTO) {
                return $roleDTO->serialize();
            }, $rolesDTos);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json($response);
    }

    public function show(string $id)
    {
        try {
            $findRolesController = new FindRoleController($this->repository);
            $roleDTO             = $findRolesController->__invoke($id);

            $response = $roleDTO->serialize();
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return response()->json($response);
    }

    public function update(string $id, Request $request)
    {
        $name        = $request->get('name');
        $permissions = $request->get('permissions');

        try {
            $updateRoleController = new UpdateRoleController($this->repository);
            $updateRoleController->__invoke($id, $name, $permissions);
        } catch (Exception $e) {
            return response($e->getMessage());
        }

        return response('Updated', 201);
    }

    public function store(Request $request)
    {
        $name        = $request->get('name');
        $permissions = $request->get('permissions');

        try {
            $createRoleController = new CreateRoleController($this->repository);
            $createRoleController->__invoke($name, $permissions);
        } catch (Exception $e) {
            return response($e->getMessage());
        }

        return response('Created', 201);
    }

    public function destroy(string $id)
    {
        try {
            $deleteRoleController = new DeleteRoleController($this->repository);
            $deleteRoleController->__invoke($id);
        } catch (Exception $e) {
            return response($e->getMessage());
        }

        return response('', 204);
    }
}
