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
use StrannyiTip\PhpTypes\Wrapper\Vector2String;

/**
 * Vector2String list.
 */
class Vector2StringList  implements Iterator, ArrayAccess, Countable, Serializable
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
     * Vector2String`s list.
     *
     * @param Vector2StringList|array $container Container
     */
    public function __construct(Vector2StringList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param Vector2String $item Vector2String one
     *
     * @return Vector2StringList
     */
    public function append(Vector2String $item): Vector2StringList
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
     * @param Vector2StringList $list Merged list
     *
     * @return Vector2StringList
     */
    public function merge(Vector2StringList $list): Vector2StringList
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
    public function offsetGet(mixed $offset): Vector2String|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Vector2String) {
            throw new InvalidArgumentException('List set argument must be of type Vector2String');
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
    public function current(): Vector2String|string
    {
        return current($this->container) ?? '';
    }
}