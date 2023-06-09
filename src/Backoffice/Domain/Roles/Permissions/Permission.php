<?php

namespace Src\Backoffice\Domain\Roles\Permissions;

class Permission
{
    private PermissionName $name;
    private PermissionValue $value;

    public function __construct(PermissionName $name, PermissionValue $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function getValue(): PermissionValue
    {
        return $this->value;
    }

    public function getName(): PermissionName
    {
        return $this->name;
    }
}