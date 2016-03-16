<?php

namespace Weew\Collections;

use ArrayIterator;
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
     * @param null $default
     *
     * @return mixed
     */
    public function first($default = null) {
        return array_first($this->items, $default);
    }

    /**
     * @param null $default
     *
     * @return mixed
     */
    public function last($default = null) {
        return array_last($this->items, $default);
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

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function offsetGet($key) {
        return $this->items[$key];
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value) {
        $this->items[$key] = $value;
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function offsetExists($key) {
        return array_key_exists($key, $this->items);
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key) {
        if ($this->offsetExists($key)) {
            unset($this->items[$key]);
        }
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator() {
        return new ArrayIterator($this->items);
    }
}
