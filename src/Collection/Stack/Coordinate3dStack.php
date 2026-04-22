<?php

namespace StrannyiTip\PhpTypes\Collection\Stack;

use Countable;
use InvalidArgumentException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;

/**
 * Stack of Coordinate3d`s.
 */
class Coordinate3dStack implements Countable
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
     * @param Coordinate3d $number Number item
     *
     * @return Coordinate3dStack
     */
    public function push(Coordinate3d $number): Coordinate3dStack
    {
        array_unshift($this->container, $number);

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
     * Top.
     *
     * @return Coordinate3d|string
     */
    public function top(): Coordinate3d|string
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
     * @param Coordinate3dStack $stack Merged stack
     *
     * @return Coordinate3dStack
     */
    public function merge(Coordinate3dStack $stack): Coordinate3dStack
    {
        return $this->mergeContainer($stack);
    }
}