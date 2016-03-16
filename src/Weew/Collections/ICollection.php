<?php

namespace Weew\Collections;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Weew\Contracts\IArrayable;

interface ICollection extends
    IItemsHolder,
    IArrayable,
    ArrayAccess,
    IteratorAggregate,
    Countable {
    /**
     * @param array $items
     */
    function merge(array $items);

    /**
     * @param ICollection $items
     */
    function extend(ICollection $items);

    /**
     * @return int
     */
    function count();

    /**
     * @param $item
     */
    function add($item);

    /**
     * @param null $default
     *
     * @return mixed
     */
    function first($default = null);

    /**
     * @param null $default
     *
     * @return mixed
     */
    function last($default = null);
}
