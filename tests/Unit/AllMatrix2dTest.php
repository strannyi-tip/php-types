<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\Matrix\Coordinate2dMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\Coordinate3dMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\MutableNumberMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\MutableRectangleMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\MutableStringMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\Vector2NumberMatrix2d;
use StrannyiTip\PhpTypes\Collection\Matrix\Vector2StringMatrix2d;
use StrannyiTip\PhpTypes\Component\Coordinate2dFactory;
use StrannyiTip\PhpTypes\Component\Coordinate3dFactory;
use StrannyiTip\PhpTypes\Component\MutableNumberFactory;
use StrannyiTip\PhpTypes\Component\MutableRectangleFactory;
use StrannyiTip\PhpTypes\Component\MutableStringFactory;
use StrannyiTip\PhpTypes\Component\Vector2NumberFactory;
use StrannyiTip\PhpTypes\Component\Vector2StringFactory;
use StrannyiTip\PhpTypes\Framework\Matrix2dAssertFramework;

class AllMatrix2dTest extends Unit
{
    private array $matrices = [
        [Coordinate2dMatrix2d::class, Coordinate2dFactory::class],
        [Coordinate3dMatrix2d::class, Coordinate3dFactory::class],
        [MutableNumberMatrix2d::class, MutableNumberFactory::class],
        [MutableRectangleMatrix2d::class, MutableRectangleFactory::class],
        [MutableStringMatrix2d::class, MutableStringFactory::class],
        [Vector2NumberMatrix2d::class, Vector2NumberFactory::class],
        [Vector2StringMatrix2d::class, Vector2StringFactory::class],
    ];

    public function testStacksAutomatically()
    {
        foreach ($this->matrices as list($matrix_class, $matrix_factory)) {
            Matrix2dAssertFramework::useTester($this)
                ->assertCreateSetHasGet($matrix_class, $matrix_factory)
                ->assertCounts($matrix_class, $matrix_factory);
        }
    }
}
