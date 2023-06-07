<?php

namespace Src\Backoffice\Users\Domain;

use Src\Shared\Domain\Entity;
use Src\Shared\Domain\Uuid;

class Permission extends Entity
{
    private string $value;
    private string $name;

    public function __construct(string $name, string $value)
    {
        $this->id    = new Uuid();
        $this->name  = $name;
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}