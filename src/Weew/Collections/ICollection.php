<?php

namespace Weew\Collections;

use Weew\Contracts\IArrayable;

interface ICollection extends IItemsHolder, IArrayable {
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
}
