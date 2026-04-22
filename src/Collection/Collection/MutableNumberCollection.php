<?php

namespace StrannyiTip\PhpTypes\Collection\Collection;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\Exception\ItemNotFoundException;
use StrannyiTip\PhpTypes\MutableNumber;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;


/**
 * Collection of MutableNumber`s.
 */
class MutableNumberCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * Collection of MutableNumber`s.
     *
     * @param MutableNumberCollection|array $collection Collection
     */
    public function __construct(MutableNumberCollection|array $collection = [])
    {
        $this->container = [];
        foreach ($collection as $key => $item) {
            $this->container[$key] = $item;
        }
    }

    /**
     * Append item.
     *
     * Set without rewrite current value!
     *
     * @param string $key Key name
     * @param MutableNumber $number Number value
     *
     * @return MutableNumberCollection
     */
    public function append(string $key, MutableNumber $number): MutableNumberCollection
    {
        if (!$this->has($key)) {
            $this->container[$key] = $number;
        }

        return $this;
    }

    /**
     * Append item.
     *
     * Set with rewrite current value.
     *
     * @param string $key Key name
     * @param MutableNumber $number Number value
     *
     * @return MutableNumberCollection
     */
    public function rewrite(string $key, MutableNumber $number): MutableNumberCollection
    {
        $this->container[$key] = $number;

        return $this;
    }

    /**
     * Check is containing key.
     *
     * @param string $key Needed key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->container);
    }

    /**
     * Get item.
     *
     * @param string $key Needed key
     *
     * @return MutableNumber|string
     */
    public function get(string $key): MutableNumber|string
    {
        return $this->has($key) ? $this->container[$key] : '';
    }

    /**
     * Get item or throw exception.
     *
     * @param string $key Needle key
     *
     * @throws ItemNotFoundException
     *
     * @return MutableNumber
     */
    public function getOrFail(string $key): MutableNumber
    {
        if ($this->has($key)) {
            return $this->container[$key];
        }

        throw new ItemNotFoundException('Item not found for key [' . $key . ']');
    }

    /**
     * Remove item.
     *
     * @param string $key Needed key
     *
     * @return MutableNumber|false
     */
    public function remove(string $key): MutableNumber|false
    {
        $value = false;

        if ($this->has($key)) {
            $value = $this->container[$key];
            unset($this->container[$key]);
        }

        return $value;
    }

    /**
     * Mix items.
     *
     * @return MutableNumberCollection
     */
    public function mix(): MutableNumberCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return MutableNumber|string
     */
    public function first(): MutableNumber|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return MutableNumber|string
     */
    public function last(): MutableNumber|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return MutableNumber|string
     */
    public function random(): MutableNumber|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return MutableNumberCollection
     */
    public function clone(): MutableNumberCollection
    {
        return new MutableNumberCollection($this->container);
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
     * Merge two collections.
     *
     * @param MutableNumberCollection $collection Merged collection
     *
     * @return MutableNumberCollection
     */
    public function merge(MutableNumberCollection $collection): MutableNumberCollection
    {
        return $this->mergeContainer($collection);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): MutableNumber|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof MutableNumber) {
            throw new InvalidArgumentException('List set argument must be of type MutableNumber');
        }
        $this->rewrite($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function current(): MutableNumber|string
    {
        return current($this->container);
    }
}