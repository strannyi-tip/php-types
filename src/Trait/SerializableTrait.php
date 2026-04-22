<?php

namespace StrannyiTip\PhpTypes\Trait;

/**
 * Serializable.
 */
trait SerializableTrait
{
    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return json_encode($this->container);
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $data): void
    {
        $this->container = json_decode($data);
    }

    public function __serialize(): array
    {
        return $this->container;
    }

    public function __unserialize(array $data): void
    {
        $this->container = $data;
    }
}