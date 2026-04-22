<?php

namespace StrannyiTip\PhpTypes\Collection\Queue;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;

/**
 * MutableString queue.
 */
class MutableStringQueue implements Countable
{
    /**
     * @param array<MutableString> $container
     */
    public function __construct(array $container = [])
    {
        foreach ($container as $item) {
            if (!$item instanceof MutableString) {
                throw new InvalidArgumentException('Array item type is not are ' . MutableString::class);
            }
            $this->container[] = $item;
        }
    }
    
    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * Push.
     *
     * @param MutableString $item Item
     *
     * @return MutableStringQueue
     */
    public function push(MutableString $item): MutableStringQueue
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Pop.
     *
     * @return MutableString|string
     */
    public function pop(): MutableString|string
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
     * @param MutableStringQueue $queue Merged queue
     *
     * @return MutableStringQueue
     */
    public function merge(MutableStringQueue $queue): MutableStringQueue
    {
        foreach ($queue->asArray() as $item) {
            $this->container[] = $item;
        }

        return $this;
    }
}