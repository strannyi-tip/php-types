<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;


use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;

/**
 * Stack of Coordinate2d`s.
 */
class Coordinate2dStack implements Countable
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
     * @param Coordinate2d $number Number item
     *
     * @return Coordinate2dStack
     */
    public function push(Coordinate2d $number): Coordinate2dStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return Coordinate2d|string
     */
    public function top(): Coordinate2d|string
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
     * @param Coordinate2dStack $stack Merged stack
     *
     * @return Coordinate2dStack
     */
    public function merge(Coordinate2dStack $stack): Coordinate2dStack
    {
        return $this->mergeContainer($stack);
    }
}
