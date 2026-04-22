<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\MutableNumber;

class MutableNumberTest extends Unit
{
    public function testCreateAndEquals()
    {
        $this->assertEquals(new MutableNumber(10)->value, new MutableNumber(10)->value, 'Compare with values');
        $this->assertEquals(new MutableNumber(10)->asInt(), new MutableNumber(10)->value, 'Compare asInt and value');
        $this->assertEquals(10, new MutableNumber(10)->value, 'Compare set and value');
        $this->assertEquals("10", new MutableNumber(10)->value, 'Compare string and value');
        $this->assertEquals("10", new MutableNumber(10)->asInt(), 'Compare string and asInt');
        $this->assertEquals(10.0, new MutableNumber(10)->asFloat(), 'Compare set and asFloat');
        $this->assertTrue(new MutableNumber(10)->asBool(), 'Get value as bool (true)');
        $this->assertFalse(new MutableNumber(0)->asBool(), 'Get value as bool (false)');
    }

    public function testMaths()
    {
        $this->assertEquals(11, new MutableNumber(10)->increment()->asInt(), 'Increment test');
        $this->assertEquals(9, new MutableNumber(10)->decrement()->asInt(), 'Decrement test');
        $this->assertEquals(5, new MutableNumber(10)->div(new MutableNumber(2))->asInt(), 'Division test');
        $this->assertEquals(4, new MutableNumber(2)->exp(new MutableNumber(2))->asInt(), 'Exponent test');
        $this->assertEquals(10, new MutableNumber(2)->mult(new MutableNumber(5))->asInt(), 'Multiplication test');
        $this->assertEquals(1, new MutableNumber(10)->mod(3)->asInt(), 'Division by module test');
    }

    public function testApplied()
    {
        $this->assertTrue(new MutableNumber(3)->isMax([1, 2, 3]), 'Value is maximum test 1');
        $this->assertTrue(new MutableNumber(1)->isMin([1, 2, 3]), 'Value is minimum test 1');
        $this->assertTrue(new MutableNumber(10)->isMax([1, 2, 3, 7, 10]), 'Value is maximum test 2');
        $this->assertTrue(new MutableNumber(10)->isMin([100, 200, 300, 700, 10]), 'Value is minimum test 2');
        $this->assertFalse(new MutableNumber(1)->isMax([1, 2, 3, 7, 10]), 'Value is maximum test (false)');
        $this->assertFalse(new MutableNumber(10)->isMin([1, 2, 3, 7, 10]), 'Value is minimum test (false)');
    }

    public function testStringable()
    {
        $this->assertEquals('Number: 777', 'Number: ' . new MutableNumber(777), 'Stringable test');
    }
}
