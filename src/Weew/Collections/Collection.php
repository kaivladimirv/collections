<?php

declare(strict_types=1);

namespace Weew\Collections;

use ArrayIterator;
use Weew\Contracts\IArrayable;

class Collection implements CollectionInterface
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = [];

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function merge(array $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function extend(CollectionInterface $items): void
    {
        $this->merge($items->getItems());
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function add(mixed $item): void
    {
        $this->items[] = $item;
    }

    public function first(mixed $default = null): mixed
    {
        return array_first($this->items, $default);
    }

    public function last(mixed $default = null): mixed
    {
        return array_last($this->items, $default);
    }

    public function toArray(): array
    {
        $items = [];

        foreach ($this->getItems() as $key => $value) {
            if ($value instanceof IArrayable) {
                $value = $value->toArray();
            }

            $items[$key] = $value;
        }

        return $items;
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetUnset(mixed $offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->items[$offset]);
        }
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
