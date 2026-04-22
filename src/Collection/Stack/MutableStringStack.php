<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;

/**
 * MutableString stack.
 */
class MutableStringStack implements Countable
{
    /**
     * Containable.
     */
    use ContainableTrait;

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
     * Push.
     *
     * @param MutableString $number Number item
     *
     * @return MutableStringStack
     */
    public function push(MutableString $number): MutableStringStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return MutableString|string
     */
    public function top(): MutableString|string
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
     * @param MutableStringStack $stack Merged stack
     *
     * @return MutableStringStack
     */
    public function merge(MutableStringStack $stack): MutableStringStack
    {
        return $this->mergeContainer($stack);
    }
}