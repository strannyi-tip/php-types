<?php

namespace Unit;

use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\MutableString;

class MutableStringTest extends \Codeception\Test\Unit
{
    public function testCreate()
    {
        $string_string = new MutableString('hello, test');
        $number_string = new MutableString(3.14);
        $typed_string = new MutableString(new MutableNumber(7));
        $mutable_string = new MutableString(new MutableString('one'));

        $this->assertEquals([
            'hello, test',
            '3.14',
            '7',
            'one',
        ], [
            $string_string->value,
            $number_string->value,
            $typed_string->value,
            $mutable_string->value,
        ], 'Test for create success with some types');
    }

    public function testIsStartsWith()
    {
        $string = new MutableString('Hello, darkness, my old friend');
        $this->assertTrue($string->isStartsWith('Hello'), 'Test for string starts with Hello');
        $this->assertFalse($string->isStartsWith('darkness'), 'Test for string not starts with darkness');
    }

    public function testIsEndsWith()
    {
        $string = new MutableString('Hello, darkness, my old friend');
        $this->assertTrue($string->isEndsWith('friend'), 'Test for string ends of friend');
        $this->assertFalse($string->isEndsWith('Hello'), 'Test for string not ends of Hello');
    }

    public function testToArray()
    {
        $string = new MutableString('abc');

        $this->assertEquals([
            'a', 'b', 'c'
        ], $string->toArray(), 'Test for toArray correct');
    }

    public function testToUpper()
    {
        $string = new MutableString('hello');
        $this->assertEquals('HELLO', $string->toUpper()->value, 'Test for to upper case correct');
    }

    public function testToLower()
    {
        $string = new MutableString('HELLO');
        $this->assertEquals('hello', $string->toLower()->value, 'Test for to lower case correct');
    }

    public function testFirstToUpper()
    {
        $string = new MutableString('hello');
        $this->assertEquals('Hello', $string->firstToUpper()->value, 'Test for first letter case up');
    }

    public function testFirstToLower()
    {
        $string = new MutableString('Hello');
        $this->assertEquals('hello', $string->firstToLower()->value, 'Test for first letter case down');
    }

    public function testAppend()
    {
        $string = new MutableString('Hello, ');
        $this->assertEquals('Hello, darkness', $string->append('darkness')->value, 'Test for string append string');
    }

    public function testPrepend()
    {
        $string = new MutableString(', darkness');
        $this->assertEquals('Hello, darkness', $string->prepend('Hello')->value, 'Test for string prepend string');
    }

    public function testFind()
    {
        $string = new MutableString('abc');
        $this->assertEquals(0, $string->find('a'), 'Test for find on start position');
        $this->assertEquals(1, $string->find('b'), 'Test for find on middle position');
        $this->assertEquals(2, $string->find('c'), 'Test for find on end position');
        $this->assertFalse($string->find('e'), 'Test for false return if string not found');
    }

    public function testMiddle()
    {
        $string = new MutableString('Hello, string');
        $this->assertEquals('string', $string->middle(-6, 6)->value, 'Test for substr middle correct');
    }

    public function testIsNumber()
    {
        $number_string = new MutableString('1812');
        $string_string = new MutableString('hello, 123');
        $this->assertTrue($number_string->isNumber(), 'Test for string only contained number is number');
        $this->assertFalse($string_string->isNumber(), 'Test for string contained not numeric symbols is not number');
    }

    public function testFill()
    {
        $string = new MutableString('');
        $this->assertEquals('111', $string->fill('1', 3)->value, 'Test for string fill by needle string needle times');
    }

    public function testDecodeJson()
    {
        $json_string = new MutableString(json_encode([
            'name' => 'Darkness',
        ]));
        $this->assertEquals([
            'name' => 'Darkness',
        ], $json_string->decodeJson(), 'Test for JSON decode correctly');
    }

    public function testEncodeJson()
    {
        $string = new MutableString('');
        $this->assertEquals(json_encode([
            'name' => 'Darkness',
        ]), $string->encodeJson(['name' => 'Darkness']), 'Test for create JSON string from array');
    }

    public function testIsContains()
    {
        $string = new MutableString('Hello, darkness');
        $this->assertTrue($string->isContains('Hello'), 'test for string contains Hello');
        $this->assertTrue($string->isContains(','), 'test for string contains ,');
        $this->assertTrue($string->isContains('darkness'), 'test for string contains darkness');
        $this->assertTrue($string->isContains(' '), 'test for string contains space');
        $this->assertFalse($string->isContains(123), 'test for string doesn`t contains 123');
    }

    public function testCreateHash()
    {
        $string = new MutableString('abc');
        $this->assertEquals(sha1('abc'), $string->hash(), 'Test for hash created with method sha1');
    }

    public function testReplaceAll()
    {
        $string = new MutableString('Hello, darknecc');
        $times = $string->replaceAll('c', 's');
        $this->assertEquals(2, $times, 'Test for replaced all substr');
        $this->assertEquals('Hello, darkness', $string->value, 'Test for replaced correctly');
    }

    public function testCount()
    {
        $string = new MutableString('Hello');
        $this->assertCount(5, $string, 'Test for implements Countable');
        $string->append(7);
        $this->assertCount(6, $string, 'Test for counted correctly');
    }
}
