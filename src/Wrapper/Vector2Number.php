<?php

namespace StrannyiTip\PhpTypes\Wrapper;

use Serializable;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use StrannyiTip\PhpTypes\Interfaces\NumberableInterface;
use StrannyiTip\PhpTypes\MutableNumber;
use Stringable;

class Vector2Number implements Stringable, Serializable, ExtendedTypeInterface
{
    /**
     * First item.
     *
     * @var NumberableInterface|MutableNumber|int|float
     */
    private(set) NumberableInterface|MutableNumber|int|float $first {
        set {
            $this->first = new MutableNumber($value);
        }
        get {
            return $this->first;
        }
    }

    /**
     * Second item.
     *
     * @var NumberableInterface|MutableNumber|int|float
     */
    private(set) NumberableInterface|MutableNumber|int|float $second {
        set {
            $this->second = new MutableNumber($value);
        }
        get {
            return $this->second;
        }
    }

    public function __construct(NumberableInterface|MutableNumber|int|float $first = 0, NumberableInterface|MutableNumber|int|float $second = 0)
    {
        $this->first = new MutableNumber($first);
        $this->second = new MutableNumber($second);
    }

    /**
     * Clear.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->first = new MutableNumber(0);
        $this->second = new MutableNumber(0);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return json_encode([
            $this->first->value,
            $this->second->value,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return json_encode([
            $this->first->value,
            $this->second->value,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $data): void
    {
        list($this->first, $this->second) = json_decode($data, true);
    }

    public function __serialize(): array
    {
        return [
            $this->first->value,
            $this->second->value,
        ];
    }

    public function __unserialize(array $data): void
    {
        list($this->first, $this->second) = $data;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::class;
    }
}