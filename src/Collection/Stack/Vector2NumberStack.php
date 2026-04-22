<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;


use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;

/**
 * Stack of Vector2Number`s.
 */
class Vector2NumberStack implements Countable
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
     * @param Vector2Number $number Number item
     *
     * @return Vector2NumberStack
     */
    public function push(Vector2Number $number): Vector2NumberStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return Vector2Number|string
     */
    public function top(): Vector2Number|string
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
     * @param Vector2NumberStack $stack Merged stack
     *
     * @return Vector2NumberStack
     */
    public function merge(Vector2NumberStack $stack): Vector2NumberStack
    {
        return $this->mergeContainer($stack);
    }
}
