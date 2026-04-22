<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;


use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;

/**
 * Stack of Vector2String`s.
 */
class Vector2StringStack implements Countable
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
     * @param Vector2String $number Number item
     *
     * @return Vector2StringStack
     */
    public function push(Vector2String $number): Vector2StringStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return Vector2String|string
     */
    public function top(): Vector2String|string
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
     * @param Vector2StringStack $stack Merged stack
     *
     * @return Vector2StringStack
     */
    public function merge(Vector2StringStack $stack): Vector2StringStack
    {
        return $this->mergeContainer($stack);
    }
}
