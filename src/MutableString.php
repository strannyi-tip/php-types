<?php

namespace StrannyiTip\PhpTypes;

use Closure;
use Countable;
use Iterator;
use Serializable;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use Stringable;

/**
 * Mutable string.
 */
class MutableString implements Stringable, Countable, Iterator, Serializable, ExtendedTypeInterface
{
    /**
     * Value.
     *
     * @var string
     */
    protected(set) string $value {
        set {
            $this->value = (string)$value;
            $this->updateIterable();
            if ($fn = $this->on_update) {
                $fn($this);
            }
        }
        get {
            return $this->value;
        }
    }

    /**
     * For iterability.
     *
     * @var array
     */
    protected array $iterable = [];

    /**
     * @var Closure|null
     */
    protected ?Closure $on_update = null;

    /**
     * Mutable string.
     *
     * @param MutableString|Stringable|string|int|float $string |int|float $string String
     */
    public function __construct(MutableString|Stringable|string|int|float $string = '')
    {
        $this->value = $string;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Starts with.
     *
     * @param Stringable|string|int|float $string Needle string
     *
     * @return bool
     */
    public function isStartsWith(Stringable|string|int|float $string): bool
    {
        return str_starts_with($this->value, $string);
    }

    /**
     * Ends with.
     *
     * @param Stringable|string|int|float $string Needle string
     *
     * @return bool
     */
    public function isEndsWith(Stringable|string|int|float $string): bool
    {
        return str_ends_with($this->value, $string);
    }

    /**
     * To array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return str_split($this->value);
    }

    /**
     * To upper case.
     *
     * @return MutableString
     */
    public function toUpper(): MutableString
    {
        $this->value = strtoupper($this->value);

        return $this;
    }

    /**
     * To lower case.
     *
     * @return MutableString
     */
    public function toLower(): MutableString
    {
        $this->value = strtolower($this->value);

        return $this;
    }

    /**
     * First letter to upper case.
     *
     * @return MutableString
     */
    public function firstToUpper(): MutableString
    {
        $this->value = ucfirst($this->value);

        return $this;
    }

    /**
     * First letter to lower case.
     *
     * @return MutableString
     */
    public function firstToLower(): MutableString
    {
        $this->value = lcfirst($this->value);

        return $this;
    }

    /**
     * Append string.
     *
     * @param Stringable|string|int|float $string String
     *
     * @return MutableString
     */
    public function append(Stringable|string|int|float $string): MutableString
    {
        $this->value .= $string;

        return $this;
    }

    /**
     * Prepend string.
     *
     * @param Stringable|string|int|float $string String
     *
     * @return MutableString
     */
    public function prepend(Stringable|string|int|float $string): MutableString
    {
        $this->value = $string . $this->value;

        return $this;
    }

    /**
     * Find substring.
     *
     * @param Stringable|string|int|float $string Needle symbols
     *
     * @return int|false
     */
    public function find(Stringable|string|int|float $string): int|false
    {
        $index = array_search($string, str_split($this->value));

        return $index === '' ? false : $index;
    }

    /**
     * Middle string.
     *
     * @param int $start Start position
     * @param int $end End position
     *
     * @return MutableString
     */
    public function middle(int $start = 0, int $end = 1): MutableString
    {
        $this->value = substr($this->value, $start, $end);

        return $this;
    }

    /**
     * Is string contains number.
     *
     * @return bool
     */
    public function isNumber(): bool
    {
        return is_numeric($this->value);
    }

    /**
     * Fill string by needles.
     *
     * @param Stringable|string|int|float $string $string Needle string
     * @param int $times Needle times
     *
     * @return MutableString
     */
    public function fill(Stringable|string|int|float $string, int $times): MutableString
    {
        $this->value = str_repeat($string, $times);

        return $this;
    }

    /**
     * Decode contains JSON to array.
     *
     * @return array
     */
    public function decodeJson(): array
    {
        return json_decode($this->value, true);
    }

    /**
     * Encode array to string.
     *
     * @param array $array Data array
     *
     * @return MutableString
     */
    public function encodeJson(array $array): MutableString
    {
        $this->value = json_encode($array);

        return $this;
    }

    /**
     * Is contains needle item.
     *
     * @param Stringable|string|int|float $string Needle
     *
     * @return bool
     */
    public function isContains(Stringable|string|int|float $string): bool
    {
        return str_contains($this->value, (string)$string);
    }

    /**
     * Hash.
     *
     * @return string
     */
    public function hash(): string
    {
        return sha1($this->value);
    }

    /**
     * Replace all.
     *
     * @param Stringable|string|int|float $needle Needle string
     * @param Stringable|string|int|float $replacement Needle replacement
     *
     * @return int
     */
    public function replaceAll(Stringable|string|int|float $needle, Stringable|string|int|float $replacement): int
    {
        $count = 0;
        $this->value = str_replace($needle, $replacement, $this->value, $count);

        return $count;
    }

    /**
     * Cut.
     *
     * @param int $length Length
     *
     * @return MutableString
     */
    public function cut(int $length): MutableString
    {
        $this->value = substr($this->value, 0, $length);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return strlen($this->value);
    }

    /**
     * @inheritDoc
     */
    public function current(): string
    {
        return current($this->iterable);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        next($this->iterable);
    }

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return key($this->iterable);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return key($this->iterable) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        reset($this->iterable);
    }

    /**
     * Update iterable array from value.
     *
     * @return void
     */
    private function updateIterable(): void
    {
        $this->iterable = str_split($this->value);
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function serialize(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function unserialize(string $data): void
    {
        $this->value = $data;
    }

    public function __serialize(): array
    {
        return [$this->value];
    }

    public function __unserialize(array $data): void
    {
        $this->value = $data[0];
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::class;
    }

    /**
     * Event on value is updated.
     *
     * @param Closure $fn Function
     *
     * @return MutableString
     */
    public function onUpdate(Closure $fn): MutableString
    {
        $this->on_update = $fn;

        return $this;
    }
}