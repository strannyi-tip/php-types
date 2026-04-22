<?php

namespace StrannyiTip\PhpTypes\Collection\Collection;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\Exception\ItemNotFoundException;
use StrannyiTip\PhpTypes\Trait\ContainableTrait;
use StrannyiTip\PhpTypes\Trait\IteratorTrait;
use StrannyiTip\PhpTypes\Trait\SerializableTrait;
use StrannyiTip\PhpTypes\Wrapper\Vector2Number;

/**
 * Vector2Number collection.
 */
class Vector2NumberCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * Collection of Vector2Number`s.
     *
     * @param Vector2NumberCollection|array $collection Collection
     */
    public function __construct(Vector2NumberCollection|array $collection = [])
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
     * @param Vector2Number $coordinate
     * @return Vector2NumberCollection
     */
    public function append(string $key, Vector2Number $coordinate): Vector2NumberCollection
    {
        if (!$this->has($key)) {
            $this->container[$key] = $coordinate;
        }

        return $this;
    }

    /**
     * Append item.
     *
     * Set with rewrite current value.
     *
     * @param string $key Key name
     * @param Vector2Number $string String
     *
     * @return Vector2NumberCollection
     */
    public function rewrite(string $key, Vector2Number $string): Vector2NumberCollection
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
     * @return Vector2Number|string
     */
    public function get(string $key): Vector2Number|string
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
     * @return Vector2Number
     */
    public function getOrFail(string $key): Vector2Number
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
     * @return Vector2Number|false
     */
    public function remove(string $key): Vector2Number|false
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
     * @return Vector2NumberCollection
     */
    public function mix(): Vector2NumberCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return Vector2Number|string
     */
    public function first(): Vector2Number|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return Vector2Number|string
     */
    public function last(): Vector2Number|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return Vector2Number|string
     */
    public function random(): Vector2Number|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return Vector2NumberCollection
     */
    public function clone(): Vector2NumberCollection
    {
        return new Vector2NumberCollection($this->container);
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
     * @param Vector2NumberCollection $collection Merged collection
     *
     * @return Vector2NumberCollection
     */
    public function merge(Vector2NumberCollection $collection): Vector2NumberCollection
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
    public function offsetGet(mixed $offset): Vector2Number|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Vector2Number) {
            throw new InvalidArgumentException('List set argument must be of type Vector2Number');
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
    public function current(): Vector2Number|string
    {
        return current($this->container);
    }
}