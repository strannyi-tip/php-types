<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\Stack\Coordinate2dStack;
use StrannyiTip\PhpTypes\Collection\Stack\Coordinate3dStack;
use StrannyiTip\PhpTypes\Collection\Stack\MutableNumberStack;
use StrannyiTip\PhpTypes\Collection\Stack\MutableStringStack;
use StrannyiTip\PhpTypes\Collection\Stack\Vector2NumberStack;
use StrannyiTip\PhpTypes\Collection\Stack\Vector2StringStack;
use StrannyiTip\PhpTypes\Component\Coordinate2dFactory;
use StrannyiTip\PhpTypes\Component\Coordinate3dFactory;
use StrannyiTip\PhpTypes\Component\MutableNumberFactory;
use StrannyiTip\PhpTypes\Component\MutableStringFactory;
use StrannyiTip\PhpTypes\Component\Vector2NumberFactory;
use StrannyiTip\PhpTypes\Component\Vector2StringFactory;
use StrannyiTip\PhpTypes\Framework\StackAssertFramework;


class AllStacksTest extends Unit
{
    private array $stacks = [
        [MutableNumberStack::class, MutableNumberFactory::class],
        [MutableStringStack::class, MutableStringFactory::class],
        [Coordinate2dStack::class, Coordinate2dFactory::class],
        [Coordinate3dStack::class, Coordinate3dFactory::class],
        [Vector2NumberStack::class, Vector2NumberFactory::class],
        [Vector2StringStack::class, Vector2StringFactory::class],
    ];

    public function testStacksAutomatically()
    {
        foreach ($this->stacks as list($stack_class, $stack_factory)) {
            StackAssertFramework::useTester($this)
                ->assertCreate($stack_class, $stack_factory)
                ->assertPushAndPop($stack_class, $stack_factory);
        }
    }
}
