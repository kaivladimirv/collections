<?php

declare(strict_types=1);

namespace Weew\Collections;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Weew\Contracts\IArrayable;

interface DictionaryInterface extends
    ItemsHolderInterface,
    IArrayable,
    ArrayAccess,
    IteratorAggregate,
    Countable
{
    public function get($key, mixed $default = null): mixed;

    public function set($key, mixed $value): void;

    public function remove($key): void;

    public function has($key): bool;

    public function take($key, mixed $default = null): mixed;

    public function add($key, mixed $value): void;

    public function merge(array $items): void;

    public function extend(DictionaryInterface $items): void;
}
