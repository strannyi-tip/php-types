<?php

namespace StrannyiTip\PhpTypes\Framework;

use Codeception\Test\Unit;
use Override;
use StrannyiTip\PhpTypes\Base\AssertFramework;

/**
 * Stack assert framework.
 */
class StackAssertFramework extends AssertFramework
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
    public static function useTester(Unit $tester): StackAssertFramework
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        self::$tester = $tester;

        return self::$instance;
    }

    public function assertCreate(string $stack_class, string $type_factory): StackAssertFramework
    {
        $stack = new $stack_class();
        self::$tester
            ->assertEmpty($stack, 'Test for stack is empty on create');
        $items = $type_factory::create(3);
        $stack_from_array = new $stack_class($items);
        self::$tester
            ->assertCount(3, $stack_from_array, 'Test for create stack from array');

        return $this;
    }

    public function assertPushAndPop(string $stack_class, string $type_factory): StackAssertFramework
    {
        $stack = new $stack_class();
        $items = $type_factory::create(3);
        $stack
            ->push($items[0])
            ->push($items[1])
            ->push($items[2]);
        self::$tester
            ->assertEquals($items[2], $stack->top());
        self::$tester
            ->assertCount(3, $stack, 'Test for stack filled by items');
        self::$tester
            ->assertEquals($items[2], $stack->pop(), 'Test for get value correctly from pop 0');
        self::$tester
            ->assertEquals($items[1], $stack->pop(), 'Test for get value correctly from pop 1');
        self::$tester
            ->assertEquals($items[0], $stack->pop(), 'Test for get value correctly from pop 2');
        self::$tester
            ->assertEmpty($stack->pop(), 'Test for stack give away all items');

        return $this;
    }
}