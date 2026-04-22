<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;

/**
 * Queue of Coordinate2d.
 */
class Coordinate2dQueue implements Countable
{
    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * @param array<Coordinate2d> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof Coordinate2d) {
                throw new InvalidArgumentException('Array item type is not are ' . Coordinate2d::class);
            }
            $this->container[] = $item;
        }
    }

    /**
     * Push.
     *
     * @param Coordinate2d $item Item
     *
     * @return Coordinate2dQueue
     */
    public function push(Coordinate2d $item): Coordinate2dQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return Coordinate2d|string
     */
    public function pop(): Coordinate2d|string
    {
        return array_shift($this->container) ?? '';
    }

    /**
     * Is empty.
     *
     * @return bool
     */
    public function empty(): bool
    {
        return count($this->container) === 0;
    }

    /**
     * Merge two queue.
     *
     * @param Coordinate2dQueue $queue Merged queue
     *
     * @return Coordinate2dQueue
     */
    public function merge(Coordinate2dQueue $queue): Coordinate2dQueue
    {
        return $this->mergeContainer($queue);
    }
}