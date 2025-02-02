<?php

declare(strict_types=1);

namespace Tests\Weew\Collections;

use PHPUnit\Framework\TestCase;
use Tests\Weew\Collections\Mocks\ArrayableItem;
use Weew\Collections\Collection;

class CollectionTest extends TestCase
{
    public function test_getters_and_setters(): void
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(
            [1, 2, 3,], $collection->getItems()
        );
        $collection->setItems([4, 5]);
        $this->assertEquals(
            [4, 5], $collection->getItems()
        );
    }

    public function test_count(): void
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(3, $collection->count());
    }

    public function test_add(): void
    {
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

    public function test_merge(): void
    {
        $collection = new Collection([1, 2]);
        $collection->merge([1, 2]);
        $this->assertEquals(
            [1, 2, 1, 2], $collection->getItems()
        );
    }

    public function test_extend(): void
    {
        $collection = new Collection([1, 2]);
        $collection->extend(new Collection([1, 2]));
        $this->assertEquals(
            [1, 2, 1, 2], $collection->getItems()
        );
    }

    public function test_to_array(): void
    {
        $collection = new Collection([1, 2]);
        $this->assertEquals([1, 2], $collection->toArray());
        $collection = new Collection([new ArrayableItem(1), new ArrayableItem(2)]);
        $this->assertEquals(
            [['id' => 1], ['id' => 2]], $collection->toArray()
        );
    }

    public function test_array_get(): void
    {
        $col = new Collection([1, 2]);
        $this->assertEquals(1, $col[0]);
        $this->assertEquals(2, $col[1]);
    }

    public function test_array_set(): void
    {
        $col = new Collection([1, 2]);
        $col[0] = 5;
        $col[4] = 7;
        $this->assertEquals([0 => 5, 1 => 2, 4 => 7], $col->getItems());
    }

    public function test_array_exists(): void
    {
        $col = new Collection([1, 2]);
        $this->assertTrue(isset($col[0]));
        $this->assertTrue(isset($col[1]));
        $this->assertFalse(isset($col[2]));
    }

    public function test_array_unset(): void
    {
        $col = new Collection([1, 2]);
        unset($col[0]);
        $this->assertEquals([1 => 2], $col->getItems());
        unset($col[1]);
        $this->assertEquals([], $col->getItems());
    }

    public function test_iterate(): void
    {
        $col = new Collection([1, 2]);
        $iterate = [];

        foreach ($col as $key => $value) {
            $iterate[$key] = $value;
        }
        $this->assertEquals($iterate, $col->getItems());

        $iterate = [];

        foreach ($col as $key => $value) {
            $iterate[$key] = $value;
        }
        $this->assertEquals($iterate, $col->getItems());
    }

    public function test_first(): void
    {
        $col = new Collection([1, 2, 3]);
        $this->assertEquals(1, $col->first('foo'));
        $this->assertEquals(1, $col->first());

        $col = new Collection([]);
        $this->assertEquals('foo', $col->first('foo'));
    }

    public function test_last(): void
    {
        $col = new Collection([1, 2, 3]);
        $this->assertEquals(3, $col->last('foo'));
        $this->assertEquals(3, $col->last());

        $col = new Collection([]);
        $this->assertEquals('foo', $col->last('foo'));
    }
}
