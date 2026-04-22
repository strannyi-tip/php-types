<?php

namespace StrannyiTip\PhpTypes\Base;


use Countable;

/**
 * Matrix 2d.
 */
abstract class AbstractMatrix2d implements Countable
{
    /**
     * Container.
     *
     * @var array
     */
    protected array $container = [];

    /**
     * Get contained value.
     *
     * @param int $x X key
     * @param int $y Y key
     *
     * @return mixed
     */
    public function get(int $x, int $y): mixed
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * Set value to contains.
     *
     * @param int $x X key
     * @param int $y Y key
     * @param mixed $value Value to contains
     *
     * @return AbstractMatrix2d
     */
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!isset($this->container[$x])) {
            $this->container[$x] = [];
        }
        $this->container[$x][$y] = $value;

        return $this;
    }

    /**
     * Is has contained value.
     *
     * @param int $x X key
     * @param int $y Y key
     *
     * @return bool
     */
    public function has(int $x, int $y): bool
    {
        return isset($this->container[$x][$y]);
    }

    /**
     * Count x lvl.
     */
    public function countX(): int
    {
        return count($this->container);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        $count = 0;
        foreach ($this->container as $container_2lvl) {
            $count += count($container_2lvl);
        }

        return $count;
    }

    /**
     * Each loop.
     *
     * @return iterable
     */
    public function forEach(): iterable
    {
        for ($x = 0; $x < $this->countX(); $x++) {
            yield $this->container[$x];
        }
    }
}
