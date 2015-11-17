<?php

namespace Weew\Collections;

use Weew\Contracts\IArrayable;

class Collection implements ICollection {
    /**
     * @var array
     */
    protected $items;

    /**
     * @param array $items
     */
    public function __construct(array $items = []) {
        $this->setItems($items);
    }

    /**
     * @return array
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items) {
        $this->items = [];

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * @param array $items
     */
    public function merge(array $items) {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * @param ICollection $items
     */
    public function extend(ICollection $items) {
        $this->merge($items->getItems());
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->items);
    }

    /**
     * @param $item
     */
    public function add($item) {
        $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function toArray() {
        $items = [];

        foreach ($this->getItems() as $key => $value) {
            if ($value instanceof IArrayable) {
                $value = $value->toArray();
            }

            $items[$key] = $value;
        }

        return $items;
    }
}
