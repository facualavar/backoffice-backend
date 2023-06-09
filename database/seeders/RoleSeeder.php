<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Backoffice\Domain\Roles\RoleId;

class RoleSeeder extends Seeder
{
    private array $allPermissions;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSuperadminRole();
        $this->createAdminRole();
        $this->createUserRole();
    }

    private function createSuperadminRole(): void
    {
        $superadminId = new RoleId();

        DB::table('roles')->insert([
            'id'        => $superadminId,
            'name'      => 'Superadmin',
            'inmutable' => true,
        ]);

        $this->createRolePermissions($superadminId, $this->getSuperadminPermissions());
    }

    private function createAdminRole(): void
    {
        $adminId = new RoleId();

        DB::table('roles')->insert([
            'id'        => $adminId,
            'name'      => 'Administrador',
            'inmutable' => true,
        ]);

        $this->createRolePermissions($adminId, $this->createAdminPermissions());
    }

    private function createUserRole(): void
    {
        $userId = new RoleId();

        DB::table('roles')->insert([
            'id'        => $userId,
            'name'      => 'Usuario',
            'inmutable' => true,
        ]);

        $this->createRolePermissions($userId, $this->getUserPermissions());
    }

    private function createRolePermissions(string $roleId, array $permissionValues): void
    {
        foreach ($permissionValues as $permissionValue) {
            DB::table('roles_permissions')->insert([
                'role_id'          => $roleId,
                'permission_value' => $permissionValue,
            ]);
        }
    }

    private function getAllPermissions(): array
    {
        $permissionValues = [];
        foreach (PermissionSeeder::CONTEXTS as $context) {
            foreach (PermissionSeeder::PERMISSIONS as $permission) {
                $permissionValues[] = $permission . '_' . $context;
            }
        }

        return $permissionValues;
    }

    private function getSuperadminPermissions(): array
    {
        return $this->getAllPermissions();
    }

    private function createAdminPermissions(): array
    {
        return array_filter($this->getAllPermissions(), function () {
            return true;
        });
    }

    private function getUserPermissions(): array
    {
        return [];
    }
}
