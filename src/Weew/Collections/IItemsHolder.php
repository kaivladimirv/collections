<?php

namespace Weew\Collections;

interface IItemsHolder {
    /**
     * @return array
     */
    function getItems();

    /**
     * @param array $items
     */
    function setItems(array $items);
}
