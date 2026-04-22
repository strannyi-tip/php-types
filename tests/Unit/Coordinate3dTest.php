<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;


class Coordinate3dTest extends Unit
{
    public function testCreatingAndAccess()
    {
        $coordinate = new Coordinate3d(1, 2, 3);
        $this->assertEquals(new MutableNumber(1), $coordinate->x, 'Test for x coordinate access correctly');
        $this->assertEquals(new MutableNumber(2), $coordinate->y, 'Test for y coordinate access correctly');
        $this->assertEquals(new MutableNumber(3), $coordinate->z, 'Test for z coordinate access correctly');
    }
}
