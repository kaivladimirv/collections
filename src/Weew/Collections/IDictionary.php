<?php

namespace Weew\Collections;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Weew\Contracts\IArrayable;

interface IDictionary extends
    IItemsHolder,
    IArrayable,
    ArrayAccess,
    IteratorAggregate,
    Countable {
    /**
     * @param $key
     *
     * @param null $default
     *
     * @return mixed
     */
    function get($key, $default = null);

    /**
     * @param $key
     * @param mixed $value
     */
    function set($key, $value);

    /**
     * @param $key
     */
    function remove($key);

    /**
     * @param $key
     *
     * @return bool
     */
    function has($key);

    /**
     * @param array $items
     */
    function merge(array $items);

    /**
     * @param IDictionary $items
     */
    function extend(IDictionary $items);
}
