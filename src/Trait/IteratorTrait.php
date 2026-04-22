<?php

namespace StrannyiTip\PhpTypes\Trait;

use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;

trait IteratorTrait
{
    /**
     * @inheritDoc
     */
    abstract public function current(): ExtendedTypeInterface|string;

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        next($this->container);
    }

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return key($this->container);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return key($this->container) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        reset($this->container);
    }
}