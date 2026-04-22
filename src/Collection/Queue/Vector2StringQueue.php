<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;


/**
 * Queue of Vector2String.
 */
class Vector2StringQueue implements Countable
{
    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * @param array<Vector2String> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof Vector2String) {
                throw new InvalidArgumentException('Array item type is not are ' . Vector2String::class);
            }
            $this->container[] = $item;
        }
    }

    /**
     * Push.
     *
     * @param Vector2String $item Item
     *
     * @return Vector2StringQueue
     */
    public function push(Vector2String $item): Vector2StringQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return Vector2String|string
     */
    public function pop(): Vector2String|string
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
     * @param Vector2StringQueue $queue Merged queue
     *
     * @return Vector2StringQueue
     */
    public function merge(Vector2StringQueue $queue): Vector2StringQueue
    {
        return $this->mergeContainer($queue);
    }
}