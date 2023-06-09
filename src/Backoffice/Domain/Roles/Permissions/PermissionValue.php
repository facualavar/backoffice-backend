<?php

namespace Src\Backoffice\Domain\Roles\Permissions;

use Src\Shared\Domain\ValueObject\StringValueObject;

final class PermissionValue implements StringValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
    public function value(): string
    {
        return $this->value;
    }
}