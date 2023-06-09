<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    const PERMISSIONS      = ['read', 'create', 'update', 'delete'];
    const PERMISSIONS_NAME = [
        'read'   => 'Listar',
        'create' => 'Crear',
        'update' => 'Modificar',
        'delete' => 'Eliminar',
    ];

    const CONTEXTS      = ['roles', 'users'];
    const CONTEXTS_NAME = [
        'roles' => 'Roles',
        'users' => 'Usuarios',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions = $this->getAllPermissions();

        foreach ($allPermissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }

    private function getAllPermissions(): array
    {
        $permissions = [];
        foreach (self::CONTEXTS as $context) {
            foreach(self::PERMISSIONS as $permission) {
                $permissionValue = $permission . '_' . $context;
                $permissionName  = self::PERMISSIONS_NAME[$permission] . ' ' . self::CONTEXTS_NAME[$context];

                $permissions[] = [
                    'value' => $permissionValue,
                    'name'  => $permissionName,
                ];
            }
        }

        return $permissions;
    }
}
