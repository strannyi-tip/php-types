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
use StrannyiTip\PhpTypes\Wrapper\Vector2String;

/**
 * Vector2String collection.
 */
class Vector2StringCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * Collection of Vector2String`s.
     *
     * @param Vector2StringCollection|array $collection Collection
     */
    public function __construct(Vector2StringCollection|array $collection = [])
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
     * @param Vector2String $item
     *
     * @return Vector2StringCollection
     */
    public function append(string $key, Vector2String $item): Vector2StringCollection
    {
        if (!$this->has($key)) {
            $this->container[$key] = $item;
        }

        return $this;
    }

    /**
     * Append item.
     *
     * Set with rewrite current value.
     *
     * @param string $key Key name
     * @param Vector2String $string String
     *
     * @return Vector2StringCollection
     */
    public function rewrite(string $key, Vector2String $string): Vector2StringCollection
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
     * @return Vector2String|string
     */
    public function get(string $key): Vector2String|string
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
     * @return Vector2String
     */
    public function getOrFail(string $key): Vector2String
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
     * @return Vector2String|false
     */
    public function remove(string $key): Vector2String|false
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
     * @return Vector2StringCollection
     */
    public function mix(): Vector2StringCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return Vector2String|string
     */
    public function first(): Vector2String|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return Vector2String|string
     */
    public function last(): Vector2String|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return Vector2String|string
     */
    public function random(): Vector2String|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return Vector2StringCollection
     */
    public function clone(): Vector2StringCollection
    {
        return new Vector2StringCollection($this->container);
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
     * @param Vector2StringCollection $collection Merged collection
     *
     * @return Vector2StringCollection
     */
    public function merge(Vector2StringCollection $collection): Vector2StringCollection
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
    public function offsetGet(mixed $offset): Vector2String|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Vector2String) {
            throw new InvalidArgumentException('List set argument must be of type Vector2String');
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
    public function current(): Vector2String|string
    {
        return current($this->container);
    }
}