<?php

namespace Tests\Weew\Collections;

use PHPUnit_Framework_TestCase;
use Tests\Weew\Collections\Mocks\ArrayableItem;
use Weew\Collections\Dictionary;

class DictionaryTest extends PHPUnit_Framework_TestCase {
    public function test_getters_and_setters() {
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

    public function test_merge() {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'foo']);
        $dict->merge(['bar' => 'baz', 'baz' => 'foo']);
        $this->assertEquals(
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'], $dict->getItems()
        );
    }

    public function test_extend() {
        $dict = new Dictionary(['foo' => 'bar', 'bar' => 'foo']);
        $dict->extend(new Dictionary(['bar' => 'baz', 'baz' => 'foo']));
        $this->assertEquals(
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'], $dict->getItems()
        );
    }
}
