<?php

namespace Src\Shared\Domain;

use Stringable;

class Uuid implements Stringable
{
    protected string $value;

    public function __construct(?string $value = null) {
        $this->value = $value ?? uniqid();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}