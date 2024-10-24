<?php

declare(strict_types=1);

namespace Weew\Collections;

use ArrayIterator;
use Weew\Contracts\IArrayable;

class Dictionary implements DictionaryInterface
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    public function get($key, mixed $default = null): mixed
    {
        return array_get($this->items, $key, $default);
    }

    public function set($key, mixed $value): void
    {
        array_set($this->items, $key, $value);
    }

    public function remove($key): void
    {
        array_remove($this->items, $key);
    }

    public function has($key): bool
    {
        return array_has($this->items, $key);
    }

    public function take($key, mixed $default = null): mixed
    {
        return array_take($this->items, $key, $default);
    }

    public function add($key, mixed $value): void
    {
        array_add($this->items, $key, $value);
    }

    public function merge(array $items): void
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function extend(DictionaryInterface $items): void
    {
        foreach ($items->getItems() as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function toArray(): array
    {
        $array = [];

        foreach ($this->items as $key => $value) {
            if ($value instanceof IArrayable) {
                $value = $value->toArray();
            }

            $array[$key] = $value;
        }

        return $array;
    }

    public function count(): int
    {
        return count($this->items);
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
