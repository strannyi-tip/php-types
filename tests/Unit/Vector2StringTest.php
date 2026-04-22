<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;


class Vector2StringTest extends Unit
{
    public function testCreate()
    {
        $vector = new Vector2String(0, 7);
        $this->assertEquals('0', $vector->first->value, 'Test for creating correctly - first');
        $this->assertEquals('7', $vector->second->value, 'Test for creating correctly - second');
    }

    public function testClear()
    {
        $vector = new Vector2String(0, 7);
        $this->assertEquals('0', $vector->first, 'Test for clearing value - first');
        $this->assertEquals('7', $vector->second->value, 'Test for clearing value - second');
        $vector->clear();
        $this->assertEmpty($vector->first->value, 'Test for check value is empty - first');
        $this->assertEmpty($vector->second->value, 'Test for check value is empty - second');
    }
}
