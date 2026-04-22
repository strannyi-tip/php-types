<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;

/**
 * MutableNumber queue.
 */
class MutableNumberQueue implements Countable
{

    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * @param array<MutableNumber> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof MutableNumber) {
                throw new InvalidArgumentException('Array item type is not are ' . MutableNumber::class);
            }
            $this->container[] = $item;
        }
    }

    /**
     * Push.
     *
     * @param MutableNumber $item Item
     *
     * @return MutableNumberQueue
     */
    public function push(MutableNumber $item): MutableNumberQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return MutableNumber|string
     */
    public function pop(): MutableNumber|string
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
     * @param MutableNumberQueue $queue Merged queue
     *
     * @return MutableNumberQueue
     */
    public function merge(MutableNumberQueue $queue): MutableNumberQueue
    {
        foreach ($queue->asArray() as $item) {
            $this->container[] = $item;
        }

        return $this;
    }
}