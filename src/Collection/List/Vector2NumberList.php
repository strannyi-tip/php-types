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
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;

/**
 * Vector2Number list.
 */
class Vector2NumberList implements Iterator, ArrayAccess, Countable, Serializable
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
     * Vector2Number`s list.
     *
     * @param Vector2NumberList|array $container Container
     */
    public function __construct(Vector2NumberList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param Vector2Number $item Vector2Number one
     *
     * @return Vector2NumberList
     */
    public function append(Vector2Number $item): Vector2NumberList
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
     * @param Vector2NumberList $list Merged list
     *
     * @return Vector2NumberList
     */
    public function merge(Vector2NumberList $list): Vector2NumberList
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
    public function offsetGet(mixed $offset): Vector2Number|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Vector2Number) {
            throw new InvalidArgumentException('List set argument must be of type Vector2Number');
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
    public function current(): Vector2Number|string
    {
        return current($this->container) ?? '';
    }
}