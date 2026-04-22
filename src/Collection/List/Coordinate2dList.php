<?php

namespace StrannyiTip\PhpTypes\Collection\List;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;

/**
 * Coordinate2d`s list.
 */
class Coordinate2dList implements Iterator, ArrayAccess, Countable, Serializable
{
    /**
     * Serializable.
     */
    use SerializableTrait;

    /**
     * Iterator.
     */
    use IteratorTrait;

    /**
     * Containable.
     */
    use ContainableTrait;

    /**
     * Coordinate2d`s list.
     *
     * @param Coordinate2dList|array $container Container
     */
    public function __construct(Coordinate2dList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param Coordinate2d $item Coordinate2d one
     *
     * @return Coordinate2dList
     */
    public function append(Coordinate2d $item): Coordinate2dList
    {
        $this->container[] = $item;

        return $this;
    }

    /**
     * Clear.
     *
     * @return int Count removed items
     */
    public function clear(): int
    {
        $removed_items_count = $this->count();
        $this->container = [];

        return $removed_items_count;
    }

    /**
     * Merge two lists.
     *
     * @param Coordinate2dList $list Merged list
     *
     * @return Coordinate2dList
     */
    public function merge(Coordinate2dList $list): Coordinate2dList
    {
        foreach ($list->asArray() as $item) {
            $this->container[] = $item;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): Coordinate2d|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Coordinate2d) {
            throw new InvalidArgumentException('List set argument must be of type Coordinate2d');
        }
        $this->container[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function current(): Coordinate2d|string
    {
        return current($this->container);
    }
}