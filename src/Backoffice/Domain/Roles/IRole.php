<?php

namespace Src\Backoffice\Domain\Roles;

use Src\Backoffice\Domain\Roles\Permissions\PermissionGroup;
use Src\Backoffice\Domain\Roles\Permissions\PermissionName;
use Src\Backoffice\Domain\Roles\Permissions\PermissionValue;
use Src\Shared\Domain\Uuid;

interface IRole {
    public function getId(): Uuid;

    public function getName(): RoleName;

    public function updateName(RoleName $newName): void;

    public function getPermissions(): array;

    public function hasPermission(PermissionValue $permissionValue): bool;

    public function updatePermissions(PermissionGroup $permissions): void;

    public function addPermission(PermissionName $permissionName, PermissionValue $permissionValue): void;

    public function removePermission(PermissionValue $permissionValue): void;

    public function isRemovable(): bool;

    public function isModifiable(): bool;
}