<?php

namespace StrannyiTip\PhpTypes\Collection\Collection;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\Exception\ItemNotFoundException;
use StrannyiTip\PhpTypes\MutableString;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;

class MutableStringCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * @param MutableStringCollection|array $collection Collection
     */
    public function __construct(MutableStringCollection|array $collection = [])
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
     * @param MutableString $string String value
     *
     * @return MutableStringCollection
     */
    public function append(string $key, MutableString $string): MutableStringCollection
    {
        if (!$this->has($key)) {
            $this->container[$key] = $string;
        }

        return $this;
    }

    /**
     * Append item.
     *
     * Set with rewrite current value.
     *
     * @param string $key Key name
     * @param MutableString $string String
     *
     * @return MutableStringCollection
     */
    public function rewrite(string $key, MutableString $string): MutableStringCollection
    {
        $this->container[$key] = $string;

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
     * @return MutableString|string
     */
    public function get(string $key): MutableString|string
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
     * @return MutableString
     */
    public function getOrFail(string $key): MutableString
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
     * @return MutableString|false
     */
    public function remove(string $key): MutableString|false
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
     * @return MutableStringCollection
     */
    public function mix(): MutableStringCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return MutableString|string
     */
    public function first(): MutableString|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return MutableString|string
     */
    public function last(): MutableString|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return MutableString|string
     */
    public function random(): MutableString|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return MutableStringCollection
     */
    public function clone(): MutableStringCollection
    {
        return new MutableStringCollection($this->container);
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
     * @param MutableStringCollection $collection Merged collection
     *
     * @return MutableStringCollection
     */
    public function merge(MutableStringCollection $collection): MutableStringCollection
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
    public function offsetGet(mixed $offset): MutableString|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof MutableString) {
            throw new InvalidArgumentException('List set argument must be of type MutableString');
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
    public function current(): MutableString|string
    {
        return current($this->container);
    }
}