<?php

namespace StrannyiTip\PhpTypes\Collection\List;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;

/**
 * MutableNumber`s list.
 */
class MutableNumberList implements Iterator, ArrayAccess, Countable, Serializable
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
     * MutableNumber`s list.
     *
     * Creating through an array does not guarantee that objects of the required type are contained.
     *
     * @param MutableNumberList|array<MutableNumber> $container Container
     */
    public function __construct(MutableNumberList|array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Append.
     *
     * @param MutableNumber $item MutableNumber one
     *
     * @return MutableNumberList
     */
    public function append(MutableNumber $item): MutableNumberList
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
     * @param MutableNumberList $list Merged list
     *
     * @return MutableNumberList
     */
    public function merge(MutableNumberList $list): MutableNumberList
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
    public function offsetGet(mixed $offset): MutableNumber|string
    {
        return $this->container[$offset] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof MutableNumber) {
            throw new InvalidArgumentException('List set argument must be of type MutableNumber');
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
    public function current(): MutableNumber|string
    {
        return current($this->container) ?? '';
    }
}