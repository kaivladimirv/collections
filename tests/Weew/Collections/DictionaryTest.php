<?php

declare(strict_types=1);

namespace Tests\Weew\Collections;

use PHPUnit\Framework\TestCase;
use Tests\Weew\Collections\Mocks\ArrayableItem;
use Weew\Collections\Dictionary;

class DictionaryTest extends TestCase
{
    public function test_getters_and_setters(): void
    {
        $dict = new Dictionary();
        $dict->set('foo', 'bar');
        $array = ['foo' => 'bar', 'bar' => 'foo', 'dict' => $dict, 'item' => new ArrayableItem('foo')];
        $wrapper = new Dictionary($array);

        $this->assertEquals('bar', $wrapper->get('foo'));
        $wrapper->set('bar', 'baz');
        $this->assertEquals('baz', $wrapper->get('bar'));
        $wrapper->remove('foo');
        $this->assertNull($wrapper->get('foo'));
        $this->assertEquals('yolo', $wrapper->get('foobar', 'yolo'));
        $this->assertFalse($wrapper->has('swag'));
        $wrapper->set('swag', 'yolo');
        $this->assertTrue($wrapper->has('swag'));
        $this->assertEquals(
            ['bar' => 'baz', 'dict' => ['foo' => 'bar'], 'swag' => 'yolo', 'item' => ['id' => 'foo']],
            $wrapper->toArray()
        );
    }

    public function test_merge(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'foo']);
        $dict->merge(['bar' => 'baz', 'baz' => 'foo']);
        $this->assertEquals(
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'], $dict->getItems()
        );
    }

    public function test_extend(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'foo']);
        $dict->extend(new Dictionary(['bar' => 'baz', 'baz' => 'foo']));
        $this->assertEquals(
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'], $dict->getItems()
        );
    }

    public function test_count(): void
    {
        $dict = new Dictionary([1, 2, 3]);
        $this->assertEquals(3, $dict->count());
    }

    public function test_array_get(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'baz' => 'yolo']);
        $this->assertEquals('bar', $dict['foo']);
    }

    public function test_array_set(): void
    {
        $dict = new Dictionary(['foo' => 'bar']);
        $dict['baz'] = 'yolo';
        $this->assertEquals(['foo' => 'bar', 'baz' => 'yolo'], $dict->getItems());
    }

    public function test_array_unset(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'baz' => 'yolo']);
        unset($dict['baz']);
        $this->assertEquals(['foo' => 'bar'], $dict->getItems());
    }

    public function test_array_exists(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'baz' => 'yolo']);
        $this->assertTrue(isset($dict['foo']));
        $this->assertTrue(isset($dict['baz']));
        $this->assertFalse(isset($dict['yolo']));
    }

    public function test_iterate(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'baz' => 'yolo']);
        $iterate = [];

        foreach ($dict as $key => $value) {
            $iterate[$key] = $value;
        }

        $this->assertEquals($dict->getItems(), $iterate);

        $iterate = [];

        foreach ($dict as $key => $value) {
            $iterate[$key] = $value;
        }

        $this->assertEquals($dict->getItems(), $iterate);
    }

    public function test_take(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'baz']);
        $this->assertEquals('bar', $dict->take('foo'));
        $this->assertEquals(['bar' => 'baz'], $dict->toArray());
    }

    public function test_add(): void
    {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'baz']);
        $dict->add('foo', 'baz');
        $this->assertEquals(['foo' => ['bar', 'baz'], 'bar' => 'baz'], $dict->toArray());
    }
}
