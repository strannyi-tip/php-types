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
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;

/**
 * Coordinate3d collection.
 */
class Coordinate3dCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * Collection of Coordinate3d`s.
     *
     * @param Coordinate3dCollection|array $collection Collection
     */
    public function __construct(Coordinate3dCollection|array $collection = [])
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
     * @param Coordinate3d $coordinate
     * @return Coordinate3dCollection
     */
    public function append(string $key, Coordinate3d $coordinate): Coordinate3dCollection
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
     * @param Coordinate3d $string String
     *
     * @return Coordinate3dCollection
     */
    public function rewrite(string $key, Coordinate3d $string): Coordinate3dCollection
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
     * @return Coordinate3d|string
     */
    public function get(string $key): Coordinate3d|string
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
     * @return Coordinate3d
     */
    public function getOrFail(string $key): Coordinate3d
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
     * @return Coordinate3d|false
     */
    public function remove(string $key): Coordinate3d|false
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
     * @return Coordinate3dCollection
     */
    public function mix(): Coordinate3dCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return Coordinate3d|string
     */
    public function first(): Coordinate3d|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return Coordinate3d|string
     */
    public function last(): Coordinate3d|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return Coordinate3d|string
     */
    public function random(): Coordinate3d|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return Coordinate3dCollection
     */
    public function clone(): Coordinate3dCollection
    {
        return new Coordinate3dCollection($this->container);
    }

    /**
     * Merge two collections.
     *
     * @param Coordinate3dCollection $collection Merged collection
     *
     * @return Coordinate3dCollection
     */
    public function merge(Coordinate3dCollection $collection): Coordinate3dCollection
    {
        return $this->mergeContainer($collection);
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
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): Coordinate3d|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Coordinate3d) {
            throw new InvalidArgumentException('List set argument must be of type Coordinate3d');
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
    public function current(): Coordinate3d|string
    {
        return current($this->container);
    }
}