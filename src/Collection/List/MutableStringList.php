<?php

namespace StrannyiTip\PhpTypes\Collection\List;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;

/**
 * MutableString`s list.
 */
class MutableStringList implements Iterator, ArrayAccess, Countable, Serializable
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
     * MutableString`s list.
     *
     * @param MutableStringList|array $container Container
     */
    public function __construct(MutableStringList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param MutableString $item MutableString one
     *
     * @return MutableStringList
     */
    public function append(MutableString $item): MutableStringList
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
     * @param MutableStringList $list Merged list
     *
     * @return MutableStringList
     */
    public function merge(MutableStringList $list): MutableStringList
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
    public function offsetGet(mixed $offset): MutableString|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof MutableString) {
            throw new InvalidArgumentException('List set argument must be of type MutableString');
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
    public function current(): MutableString|string
    {
        return current($this->container);
    }
}