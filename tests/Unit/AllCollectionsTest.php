<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\Collection\Coordinate2dCollection;
use StrannyiTip\PhpTypes\Collection\Collection\Coordinate3dCollection;
use StrannyiTip\PhpTypes\Collection\Collection\MutableNumberCollection;
use StrannyiTip\PhpTypes\Collection\Collection\MutableStringCollection;
use StrannyiTip\PhpTypes\Collection\Collection\Vector2NumberCollection;
use StrannyiTip\PhpTypes\Collection\Collection\Vector2StringCollection;
use StrannyiTip\PhpTypes\Framework\CollectionAssertFramework;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;


class AllCollectionsTest extends Unit
{
    private array $collections = [
        [Coordinate2dCollection::class, Coordinate2d::class],
        [Coordinate3dCollection::class, Coordinate3d::class],
        [MutableNumberCollection::class, MutableNumber::class],
        [MutableStringCollection::class, MutableString::class],
        [Vector2NumberCollection::class, Vector2Number::class],
        [Vector2StringCollection::class, Vector2String::class],
    ];

    public function testCollectionsAutomatically()
    {
        foreach ($this->collections as list($collection_class, $type_class)) {
            CollectionAssertFramework::useTester($this)
                ->assertCreateFromArrayAndAppendAndAssert($collection_class,  $type_class)
                ->assertCloneAndMixMethods($collection_class,  $type_class)
                ->assertRemoveMethod($collection_class,  $type_class)
                ->assertRewriteMethodAndThatAppendNotRewrite($collection_class,  $type_class)
                ->assertAppendMethod($collection_class,  $type_class)
                ->assertClearAndCountMethods($collection_class,  $type_class)
                ->assertFirstAndLastMethods($collection_class,  $type_class)
                ->assertHasMethod($collection_class,  $type_class)
                ->assertRandomMethod($collection_class,  $type_class);
        }
    }
}
