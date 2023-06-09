<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

interface StringValueObject
{
    public function __construct(string $value);

    public function value(): string;
}
