<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;

/**
 * Queue of Vector2Number.
 */
class Vector2NumberQueue implements Countable
{
    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * @param array<Vector2Number> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof Vector2Number) {
                throw new InvalidArgumentException('Array item type is not are ' . Vector2Number::class);
            }
            $this->container[] = $item;
        }
    }

    /**
     * Push.
     *
     * @param Vector2Number $item Item
     *
     * @return Vector2NumberQueue
     */
    public function push(Vector2Number $item): Vector2NumberQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return Vector2Number|string
     */
    public function pop(): Vector2Number|string
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
     * @param Vector2NumberQueue $queue Merged queue
     *
     * @return Vector2NumberQueue
     */
    public function merge(Vector2NumberQueue $queue): Vector2NumberQueue
    {
        return $this->mergeContainer($queue);
    }
}