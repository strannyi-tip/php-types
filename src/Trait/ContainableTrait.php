<?php

namespace StrannyiTip\PhpTypes\Trait;

use Closure;

trait ContainableTrait
{
    /**
     * Container.
     *
     * @var array
     */
    protected array $container = [];

    /**
     * On update event.
     *
     * @var Closure|null
     */
    protected ?Closure $on_update = null;

    /**
     * Get collection as array.
     *
     * @return array
     */
    public function asArray(): array
    {
        return $this->container;
    }

    /**
     * @see \Countable::count()
     */
    public function count(): int
    {
        return count($this->container);
    }

    /**
     * Merge two collections.
     *
     * @param mixed $container
     *
     * @return static
     */
    public function mergeContainer(mixed $container): static
    {
        foreach ($container as $item) {
            $this->container[] = $item;
        }
        $update = $this->on_update;
        $update();

        return $this;
    }

    /**
     * On update event.
     *
     * @param Closure $fn Function
     *
     * @return void
     */
    public function onUpdate(\Closure $fn): void
    {
        $this->on_update = $fn;
    }
}