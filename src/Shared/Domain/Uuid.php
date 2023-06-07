<?php

namespace Src\Shared\Domain;

class Uuid
{
    protected string $value;

    public function __construct() {
        $this->value = uniqid();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}