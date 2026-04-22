<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\Queue\Coordinate2dQueue;
use StrannyiTip\PhpTypes\Collection\Queue\Coordinate3dQueue;
use StrannyiTip\PhpTypes\Collection\Queue\MutableNumberQueue;
use StrannyiTip\PhpTypes\Collection\Queue\MutableStringQueue;
use StrannyiTip\PhpTypes\Collection\Queue\Vector2NumberQueue;
use StrannyiTip\PhpTypes\Collection\Queue\Vector2StringQueue;
use StrannyiTip\PhpTypes\Component\Coordinate2dFactory;
use StrannyiTip\PhpTypes\Component\Coordinate3dFactory;
use StrannyiTip\PhpTypes\Component\MutableNumberFactory;
use StrannyiTip\PhpTypes\Component\MutableStringFactory;
use StrannyiTip\PhpTypes\Component\Vector2NumberFactory;
use StrannyiTip\PhpTypes\Component\Vector2StringFactory;
use StrannyiTip\PhpTypes\Framework\QueueAssertFramework;


class AllQueuesTest extends Unit
{
    private array $queues = [
        [MutableNumberQueue::class, MutableNumberFactory::class],
        [MutableStringQueue::class, MutableStringFactory::class],
        [Coordinate2dQueue::class, Coordinate2dFactory::class],
        [Coordinate3dQueue::class, Coordinate3dFactory::class],
        [Vector2NumberQueue::class, Vector2NumberFactory::class],
        [Vector2StringQueue::class, Vector2StringFactory::class],
    ];

    public function testQueuesAutomatically()
    {
        foreach ($this->queues as list($queue_class, $queue_factory)) {
            QueueAssertFramework::useTester($this)
                ->assertCreate($queue_class, $queue_factory)
                ->assertPushAndPop($queue_class, $queue_factory);
        }
    }
}
