<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Collection implements Countable, IteratorAggregate
{
    protected array $items;
    protected $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    protected function getType(): string
    {
        return $this->type;
    }

    public function setItems(array $items): void
    {
        Assert::arrayOf($this->getType(), $items);

        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->getItems());
    }

    public function count(): int
    {
        return count($this->getItems());
    }
}
