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
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;

/**
 * Coordinate3d`s list.
 */
class Coordinate3dList implements Iterator, ArrayAccess, Countable, Serializable
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
     * Coordinate3d`s list.
     *
     * @param Coordinate3dList|array $container Container
     */
    public function __construct(Coordinate3dList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param Coordinate3d $item Coordinate3d one
     *
     * @return Coordinate3dList
     */
    public function append(Coordinate3d $item): Coordinate3dList
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
     * @param Coordinate3dList $list Merged list
     *
     * @return Coordinate3dList
     */
    public function merge(Coordinate3dList $list): Coordinate3dList
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
    public function offsetGet(mixed $offset): Coordinate3d|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Coordinate3d) {
            throw new InvalidArgumentException('List set argument must be of type Coordinate3d');
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
    public function current(): Coordinate3d|string
    {
        return current($this->container);
    }
}