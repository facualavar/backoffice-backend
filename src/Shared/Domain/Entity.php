<?php

namespace Src\Shared\Domain;

abstract class Entity
{
    protected Uuid $id;

    public function getId(): string
    {
        return $this->id->getValue();
    }
}