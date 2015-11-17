<?php

namespace Weew\Collections;

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
}
