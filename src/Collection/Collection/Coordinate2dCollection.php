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
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;

/**
 * Coordinate2d collection.
 */
class Coordinate2dCollection implements Countable, ArrayAccess, Iterator, Serializable
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
     * Collection of Coordinate2d`s.
     *
     * @param Coordinate2dCollection|array $collection Collection
     */
    public function __construct(Coordinate2dCollection|array $collection = [])
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
     * @param Coordinate2d $coordinate
     * @return Coordinate2dCollection
     */
    public function append(string $key, Coordinate2d $coordinate): Coordinate2dCollection
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
     * @param Coordinate2d $string String
     *
     * @return Coordinate2dCollection
     */
    public function rewrite(string $key, Coordinate2d $string): Coordinate2dCollection
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
     * @return Coordinate2d|string
     */
    public function get(string $key): Coordinate2d|string
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
     * @return Coordinate2d
     */
    public function getOrFail(string $key): Coordinate2d
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
     * @return Coordinate2d|false
     */
    public function remove(string $key): Coordinate2d|false
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
     * @return Coordinate2dCollection
     */
    public function mix(): Coordinate2dCollection
    {
        shuffle($this->container);

        return $this;
    }

    /**
     * Get first item.
     *
     * @return Coordinate2d|string
     */
    public function first(): Coordinate2d|string
    {
        return $this->get(array_key_first($this->container));
    }

    /**
     * Get last item.
     *
     * @return Coordinate2d|string
     */
    public function last(): Coordinate2d|string
    {
        return $this->get(array_key_last($this->container));
    }

    /**
     * Get random item.
     *
     * @return Coordinate2d|string
     */
    public function random(): Coordinate2d|string
    {
        return array_rand($this->container) ?? '';
    }

    /**
     * Clone collection.
     *
     * @return Coordinate2dCollection
     */
    public function clone(): Coordinate2dCollection
    {
        return new Coordinate2dCollection($this->container);
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
     * @param Coordinate2dCollection $container Merged collection
     *
     * @return Coordinate2dCollection
     */
    public function merge(Coordinate2dCollection $container): Coordinate2dCollection
    {
        return $this->mergeContainer($container);
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
    public function offsetGet(mixed $offset): Coordinate2d|string
    {
        return $this->get($offset ?? '');
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$value instanceof Coordinate2d) {
            throw new InvalidArgumentException('List set argument must be of type Coordinate2d');
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
    public function current(): Coordinate2d|string
    {
        return current($this->container);
    }
}