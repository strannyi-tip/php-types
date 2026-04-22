<?php

namespace StrannyiTip\PhpTypes\Framework;


use Codeception\Test\Unit;
use Override;
use StrannyiTip\PhpTypes\Base\AssertFramework;

class QueueAssertFramework extends AssertFramework
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
    public static function useTester(Unit $tester): QueueAssertFramework
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        self::$tester = $tester;

        return self::$instance;
    }

    public function assertCreate(string $queue_class, string $queue_factory): QueueAssertFramework
    {
        $queue = new $queue_class();
        self::$tester
            ->assertTrue($queue->empty(), 'Test for queue is empty on create');
        $queue_from_construct = new $queue_class($queue_factory::create(3));
        self::$tester
            ->assertCount(3, $queue_from_construct, 'Test for queue fill from array');

        return $this;
    }

    public function assertPushAndPop(string $queue_class, string $queue_factory): QueueAssertFramework
    {
        $queue = new $queue_class();
        $queue->push($queue_factory::create(1)[0]);
        self::$tester
            ->assertEquals($queue_factory::create(1)[0], $queue->pop(), 'Test for push and pop methods');
        self::$tester
            ->assertCount(0, $queue, 'Test for pop method remove item success');
        self::$tester
            ->assertEmpty($queue->pop(), 'Test for pop return empty string if is empty');

        return $this;
    }
}
