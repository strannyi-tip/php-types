<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;

/**
 * MutableNumber stack.
 */
class MutableNumberStack implements Countable
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
     * @param MutableNumber $number Number item
     *
     * @return MutableNumberStack
     */
    public function push(MutableNumber $number): MutableNumberStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return MutableNumber|string
     */
    public function top(): MutableNumber|string
    {
        return $this->container[0];
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
     * Merge two stacks.
     *
     * @param MutableNumberStack $stack Merged stack
     *
     * @return MutableNumberStack
     */
    public function merge(MutableNumberStack $stack): MutableNumberStack
    {
        return $this->mergeContainer($stack);
    }
}