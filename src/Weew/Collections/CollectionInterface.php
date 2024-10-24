<?php

declare(strict_types=1);

namespace Weew\Collections;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Weew\Contracts\IArrayable;

interface CollectionInterface extends
    ItemsHolderInterface,
    IArrayable,
    ArrayAccess,
    IteratorAggregate,
    Countable
{
    public function merge(array $items): void;

    public function extend(CollectionInterface $items): void;

    public function count(): int;

    public function add(mixed $item): void;

    public function first(mixed $default = null): mixed;

    public function last(mixed $default = null): mixed;
}
