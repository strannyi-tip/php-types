<?php

namespace StrannyiTip\PhpTypes\Wrapper;

use Serializable;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use StrannyiTip\PhpTypes\MutableString;
use Stringable;

class Vector2String implements Stringable, Serializable, ExtendedTypeInterface
{
    /**
     * First item.
     *
     * @var Stringable|MutableString|string
     */
    private(set) Stringable|MutableString|string $first {
        set {
            $this->first = $value;
        }
        get {
            return $this->first;
        }
    }

    /**
     * Second item.
     *
     * @var Stringable|MutableString|string
     */
    private(set) Stringable|MutableString|string $second {
        set {
            $this->second = $value;
        }
        get {
            return $this->second;
        }
    }

    public function __construct(Stringable|MutableString|string $first = '', Stringable|MutableString|string $second = '')
    {
        $this->first = new MutableString($first);
        $this->second = new MutableString($second);
    }

    /**
     * Clear.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->first = new MutableString();
        $this->second = new MutableString();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->first . ',' . $this->second;
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return json_encode([
            $this->first,
            $this->second,
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
            $this->first,
            $this->second,
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