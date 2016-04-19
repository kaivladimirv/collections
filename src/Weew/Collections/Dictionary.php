<?php

namespace Weew\Collections;

use ArrayIterator;
use Weew\Contracts\IArrayable;

class Dictionary implements IDictionary {
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
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null) {
        return array_get($this->items, $key, $default);
    }

    /**
     * @param $key
     * @param mixed $value
     */
    public function set($key, $value) {
        array_set($this->items, $key, $value);
    }

    /**
     * @param $key
     */
    public function remove($key) {
        array_remove($this->items, $key);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key) {
        return array_has($this->items, $key);
    }

    /**
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function take($key, $default = null) {
        return array_take($this->items, $key, $default);
    }

    /**
     * @param $key
     * @param $value
     */
    public function add($key, $value) {
        array_add($this->items, $key, $value);
    }

    /**
     * @param array $items
     */
    public function merge(array $items) {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @param IDictionary $items
     */
    public function extend(IDictionary $items) {
        foreach ($items->getItems() as $key => $value) {
            $this->set($key, $value);
        }
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
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function toArray() {
        $array = [];

        foreach ($this->items as $key => $value) {
            if ($value instanceof IArrayable) {
                $value = $value->toArray();
            }

            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->items);
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
