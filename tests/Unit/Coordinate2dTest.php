<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;


class Coordinate2dTest extends Unit
{
    public function testCreatingAndAccess()
    {
        $coordinate = new Coordinate2d(1, 2);
        $this->assertEquals(new MutableNumber(1), $coordinate->x, 'Test for x coordinate access correctly');
        $this->assertEquals(new MutableNumber(2), $coordinate->y, 'Test for y coordinate access correctly');
    }
}
