<?php

namespace StrannyiTip\PhpTypes\Framework;


use Codeception\Test\Unit;
use Override;
use StrannyiTip\PhpTypes\Base\AssertFramework;

class CollectionAssertFramework extends AssertFramework
{
    /**
     * Instance.
     *
     * @var mixed
     */
    private static mixed $instance = null;

    /**
     * Initializing method.
     *
     * @param Unit $tester Tester
     *
     * @return mixed
     */
    public static function useTester(Unit $tester): CollectionAssertFramework
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        self::$tester = $tester;

        return self::$instance;
    }

    public function assertCreateFromArrayAndAppendAndAssert(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection_from_array = new $collection_class([
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ]);
        $collection_from_append = new $collection_class()
            ->append('one', new $type_class(1))
            ->append('two', new $type_class(2))
            ->append('three', new $type_class(3));
        self::$tester->assertEquals($collection_from_array, $collection_from_append, 'Check if two create methods make equals objects');

        return $this;
    }

    public function assertAppendMethod(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class();
        self::$tester->assertFalse($collection->has('item'), 'Test for collection doesn`t have key before append');
        $collection->append('item', new $type_class(7));
        self::$tester->assertTrue($collection->has('item'), 'Test for collection have key after append');

        return $this;
    }

    public function assertRewriteMethodAndThatAppendNotRewrite(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class();
        $collection
            ->append('item', new $type_class(1))
            ->append('item', new $type_class(7));
        self::$tester->assertEquals(new $type_class(1), $collection->get('item'));
        $collection->rewrite('item', new $type_class(33));
        self::$tester->assertEquals(new $type_class(33), $collection->get('item'));

        return $this;
    }

    public function assertHasMethod(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class([
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ]);
        self::$tester->assertTrue($collection->has('one'), 'Check ::has with exists key');
        self::$tester->assertFalse($collection->has('four'), 'Check ::has with no exists key');

        return $this;
    }

    public function assertRemoveMethod(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class([
            'item' => new $type_class(7),
        ]);
        self::$tester->assertTrue($collection->has('item'), 'Test for has item before removing');
        $removed_item = $collection->remove('item');
        self::$tester->assertFalse($collection->has('item'), 'Test for has`t item after removing');
        self::$tester->assertEquals($removed_item, new $type_class(7), 'Test for receive removed item');

        return $this;
    }

    public function assertCloneAndMixMethods(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class([
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ]);
        $new_collection = $collection->clone();
        self::$tester->assertEquals($collection, $new_collection, 'Test for collection cloned successfully');
        self::$tester->assertNotEquals($new_collection, $collection->mix(), 'Test for collection mixed successfully');

        return $this;
    }

    public function assertFirstAndLastMethods(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class([
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ]);

        self::$tester->assertEquals(new $type_class(1), $collection->first(), 'Test ::first method');
        self::$tester->assertEquals(new $type_class(3), $collection->last(), 'Test ::last method');

        return $this;
    }

    public function assertRandomMethod(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $array = [
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ];
        $collection = new $collection_class($array);
        self::$tester->assertArrayHasKey($collection->random(), $array, 'Test for ::random method get existing item');

        return $this;
    }

    public function assertClearAndCountMethods(string $collection_class, string $type_class): CollectionAssertFramework
    {
        $collection = new $collection_class([
            'one' => new $type_class(1),
            'two' => new $type_class(2),
            'three' => new $type_class(3),
        ]);
        self::$tester->assertEquals(3, $collection->count(), 'Test ::count method correct');
        $collection->clear();
        self::$tester->assertEquals(0, $collection->count(), 'Test for ::clear method remove all items');

        return $this;
    }
}