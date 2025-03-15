<?php

namespace moxemus\array;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testGetValue()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertEquals('bar', Helper::getValue('foo', $array));
        $this->assertEquals('qux', Helper::getValue('baz', $array));
        $this->assertNull(Helper::getValue('nonexistent', $array));
    }

    public function testGetIntOrNull()
    {
        $array = ['foo' => 42, 'baz' => 'qux'];
        $this->assertEquals(42, Helper::getIntOrNull('foo', $array));
        $this->assertNull(Helper::getIntOrNull('baz', $array));
        $this->assertNull(Helper::getIntOrNull('nonexistent', $array));
    }

    public function testGetBoolOrNull()
    {
        $array = ['foo' => true, 'baz' => 'qux'];
        $this->assertEquals(true, Helper::getBoolOrNull('foo', $array));
        $this->assertNull(Helper::getBoolOrNull('baz', $array));
        $this->assertNull(Helper::getBoolOrNull('nonexistent', $array));
    }

    public function testGetFirstValue()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertEquals('bar', Helper::getFirstValue($array));
        $array = [];
        $this->assertNull(Helper::getFirstValue($array));
    }

    public function testGetLastValue()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertEquals('qux', Helper::getLastValue($array));
        $array = [];
        $this->assertNull(Helper::getLastValue($array));
    }

    public function testGetFirstValues()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux', 'quux' => 'corge'];
        $this->assertEquals(['bar', 'qux'], Helper::getFirstValues($array, 2));
        $this->assertEquals(['bar'], Helper::getFirstValues($array, 1));
        $this->assertEquals([], Helper::getFirstValues($array, 0));
    }

    public function testGetLastValues()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux', 'quux' => 'corge'];
        $this->assertEquals(['qux', 'corge'], Helper::getLastValues($array, 2));
        $this->assertEquals(['corge'], Helper::getLastValues($array, 1));
        $this->assertEquals([], Helper::getLastValues($array, 0));
    }

    public function testGetKeys()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertEquals(['foo', 'baz'], Helper::getKeys($array));
        $array = [];
        $this->assertEquals([], Helper::getKeys($array));
    }

    public function testGetValues()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertEquals(['bar', 'qux'], Helper::getValues($array));
        $array = [];
        $this->assertEquals([], Helper::getValues($array));
    }

    public function testArrayContains()
    {
        $array = ['foo' => 'bar', 'baz' => ['qux' => 'corge']];
        $this->assertTrue(Helper::arrayContains(['qux' => 'corge'], $array));
        $this->assertFalse(Helper::arrayContains(['qux' => 'wrong'], $array));
    }

    public function testRemoveValue()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertTrue(Helper::removeValue($array, 'bar'));
        $this->assertEquals(['baz' => 'qux'], $array);
        $this->assertFalse(Helper::removeValue($array, 'nonexistent'));
    }

    public function testIsEmpty()
    {
        $array = ['foo' => 'bar', 'baz' => 'qux'];
        $this->assertFalse(Helper::isEmpty($array));
        $array = [];
        $this->assertTrue(Helper::isEmpty($array));
        $array = ['foo' => null, 'baz' => ''];
        $this->assertTrue(Helper::isEmpty($array));
    }

    public function testGetMinIndex()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals('baz', Helper::getMinIndex($array));
        $array = [];
        $this->assertNull(Helper::getMinIndex($array));
    }

    public function testGetMaxIndex()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals('foo', Helper::getMaxIndex($array));
        $array = [];
        $this->assertNull(Helper::getMaxIndex($array));
    }

    public function testGetMinValue()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(24, Helper::getMinValue($array));
        $array = [];
        $this->assertNull(Helper::getMinValue($array));
    }

    public function testGetMaxValue()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(42, Helper::getMaxValue($array));
        $array = [];
        $this->assertNull(Helper::getMaxValue($array));
    }

    public function testGetSum()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(66, Helper::getSum($array));
        $array = [];
        $this->assertEquals(0, Helper::getSum($array));
    }

    public function testGetAverage()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(33, Helper::getAverage($array));
        $array = [];
        $this->assertNull(Helper::getAverage($array));
    }

    public function testGetMedian()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(33, Helper::getMedian($array));
        $array = [];
        $this->assertNull(Helper::getMedian($array));
    }

    public function testGetMode()
    {
        $array = ['foo' => 42, 'baz' => 24, 'qux' => 42];
        $this->assertEquals(42, Helper::getMode($array));
        $array = [];
        $this->assertNull(Helper::getMode($array));
    }

    public function testGetRange()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(18, Helper::getRange($array));
        $array = [];
        $this->assertEquals(0, Helper::getRange($array));
    }

    public function testGetVariance()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(72, Helper::getVariance($array));
        $array = [];
        $this->assertNull(Helper::getVariance($array));
    }

    public function testGetStandardDeviation()
    {
        $array = ['foo' => 42, 'baz' => 24];
        $this->assertEquals(8.485281237811957, Helper::getStandardDeviation($array));
        $array = [];
        $this->assertNull(Helper::getStandardDeviation($array));
    }
}
