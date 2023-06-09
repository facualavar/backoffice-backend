<?php

namespace Src\Backoffice\Domain\Roles\Permissions;

use Src\Shared\Domain\ValueObject\StringValueObject;

final class PermissionName implements StringValueObject
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function value(): string
    {
        return $this->name;
    }
}