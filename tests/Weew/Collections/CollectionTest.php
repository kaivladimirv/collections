<?php

namespace Tests\Weew\Collections;

use PHPUnit_Framework_TestCase;
use Tests\Weew\Collections\Mocks\ArrayableItem;
use Weew\Collections\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase {
    public function test_getters_and_setters() {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(
            [1, 2, 3,], $collection->getItems()
        );
        $collection->setItems([4, 5]);
        $this->assertEquals(
            [4, 5], $collection->getItems()
        );
    }

    public function test_count() {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(3, $collection->count());
    }

    public function test_add() {
        $collection = new Collection();
        $this->assertEquals(0, $collection->count());
        $collection->add(1);
        $this->assertEquals(1, $collection->count());
        $collection->add(1);
        $this->assertEquals(2, $collection->count());
        $this->assertEquals(
            [1, 1], $collection->getItems()
        );
    }

    public function test_merge() {
        $collection = new Collection([1, 2]);
        $collection->merge([1, 2]);
        $this->assertEquals(
            [1, 2, 1, 2], $collection->getItems()
        );
    }

    public function test_extend() {
        $collection = new Collection([1, 2]);
        $collection->extend(new Collection([1, 2]));
        $this->assertEquals(
            [1, 2, 1, 2], $collection->getItems()
        );
    }

    public function test_to_array() {
        $collection = new Collection([1, 2]);
        $this->assertEquals([1, 2], $collection->toArray());
        $collection = new Collection([new ArrayableItem(1), new ArrayableItem(2)]);
        $this->assertEquals(
            [['id' => 1], ['id' => 2]], $collection->toArray()
        );
    }
}
