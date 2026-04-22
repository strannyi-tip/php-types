<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;

/**
 * Queue of Coordinate3d.
 */
class Coordinate3dQueue implements Countable
{
    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * @param array<Coordinate3d> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof Coordinate3d) {
                throw new InvalidArgumentException('Array item type is not are ' . Coordinate3d::class);
            }
            $this->container[] = $item;
        }
    }

    /**
     * Push.
     *
     * @param Coordinate3d $item Item
     *
     * @return Coordinate3dQueue
     */
    public function push(Coordinate3d $item): Coordinate3dQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return Coordinate3d|string
     */
    public function pop(): Coordinate3d|string
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
     * @param Coordinate3dQueue $queue Merged queue
     *
     * @return Coordinate3dQueue
     */
    public function merge(Coordinate3dQueue $queue): Coordinate3dQueue
    {
        return $this->mergeContainer($queue);
    }
}