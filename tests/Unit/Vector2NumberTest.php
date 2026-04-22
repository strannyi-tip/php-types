<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;

class Vector2NumberTest extends Unit
{
    public function testCreate()
    {
        $vector = new Vector2Number(0, 7);
        $this->assertEquals(0, $vector->first->value, 'Test for creating correctly - first');
        $this->assertEquals(7, $vector->second->value, 'Test for creating correctly - second');
    }

    public function testClear()
    {
        $vector = new Vector2Number(0, 7);
        $this->assertEquals(0, $vector->first->value, 'Test for clearing value - first');
        $this->assertEquals(7, $vector->second->value, 'Test for clearing value - second');
        $vector->clear();
        $this->assertEquals(0, $vector->first->value, 'Test for check value is 0 - first');
        $this->assertEquals(0, $vector->second->value, 'Test for check value is 0 - second');
    }
}
