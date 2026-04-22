<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\List\Coordinate2dList;
use StrannyiTip\PhpTypes\Collection\List\Coordinate3dList;
use StrannyiTip\PhpTypes\Collection\List\MutableNumberList;
use StrannyiTip\PhpTypes\Collection\List\MutableStringList;
use StrannyiTip\PhpTypes\Collection\List\Vector2NumberList;
use StrannyiTip\PhpTypes\Collection\List\Vector2StringList;
use StrannyiTip\PhpTypes\Component\Coordinate2dFactory;
use StrannyiTip\PhpTypes\Component\Coordinate3dFactory;
use StrannyiTip\PhpTypes\Component\MutableNumberFactory;
use StrannyiTip\PhpTypes\Component\MutableStringFactory;
use StrannyiTip\PhpTypes\Component\Vector2NumberFactory;
use StrannyiTip\PhpTypes\Component\Vector2StringFactory;
use StrannyiTip\PhpTypes\Framework\ListAssertFramework;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;


class AllListsTest extends Unit
{
    private array $lists = [
        [MutableNumberList::class, MutableNumberFactory::class, MutableNumber::class],
        [MutableStringList::class, MutableStringFactory::class, MutableString::class],
        [Coordinate2dList::class, Coordinate2dFactory::class, Coordinate2d::class],
        [Coordinate3dList::class, Coordinate3dFactory::class, Coordinate3d::class],
        [Vector2NumberList::class, Vector2NumberFactory::class, Vector2Number::class],
        [Vector2StringList::class, Vector2StringFactory::class, Vector2String::class],
    ];
    
    public function testListsAutomatically()
    {
        foreach ($this->lists as list($list_class, $factory_class, $type_class)) {
            ListAssertFramework::useTester($this)
                ->assertsCreating(
                    $list_class,
                    $factory_class,
                    $type_class,
                )
                ->assertsClearMethod(
                    $list_class,
                    $factory_class,
                )
                ->assertsMergeMethod(
                    $list_class,
                    $factory_class,
                );
        }
    }
}
