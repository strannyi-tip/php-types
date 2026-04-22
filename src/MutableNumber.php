<?php

namespace StrannyiTip\PhpTypes;
use DivisionByZeroError;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use StrannyiTip\PhpTypes\Interfaces\NumberableInterface;
use Stringable;

/**
 * Number.
 */
class MutableNumber implements Stringable, ExtendedTypeInterface, NumberableInterface
{
    /**
     * Value.
     *
     * @var float
     */
    private(set) float $value {
        set(int|float|string $new_value) {
            $this->value = floatval($new_value);
        }
        get {
            return $this->value;
        }
    }

    /**
     * Value.
     *
     * @param int|float|string $new_value New value
     */
    public function __construct(int|float|string  $new_value = 0)
    {
        $this->value = $new_value;
    }

    /**
     * Increment.
     *
     * @return MutableNumber
     */
    public function increment(): MutableNumber
    {
        $this->value++;

        return $this;
    }

    /**
     * Decrement.
     *
     * @return MutableNumber
     */
    public function decrement(): MutableNumber
    {
        $this->value--;

        return $this;
    }

    /**
     * Division by module.
     *
     * @param int|float|string $module Module
     *
     * @return $this
     */
    public function mod(int|float|string $module): MutableNumber
    {
        $this->value %= intval($module);

        return $this;
    }

    /**
     * Division.
     *
     * @param int|float|string $number Number
     *
     * @return MutableNumber
     *
     * @throws DivisionByZeroError
     */
    public function div(int|float|string $number): MutableNumber
    {
        if (0 === intval($number)) {
            throw new DivisionByZeroError('Division by zero');
        }

        $this->value /= intval($number);

        return $this;
    }

    /**
     * Exponentiation.
     *
     * @param int|float|string $exponent Exponent
     *
     * @return MutableNumber
     */
    public function exp(int|float|string $exponent): MutableNumber
    {
        $this->value **= intval($exponent);

        return $this;
    }

    /**
     * Multiplication.
     *
     * @param int|float|string $number Number
     *
     * @return MutableNumber
     */
    public function mult(int|float|string $number): MutableNumber
    {
        $this->value *= intval($number);

        return $this;
    }

    /**
     * Is number max of set.
     *
     * @param array $numbers Numbers set
     *
     * @return bool
     */
    public function isMax(array $numbers): bool
    {
        $final_array = $this->getValuesOfNumerable($numbers);
        rsort($final_array);

        return $final_array[0] === $this->value;
    }

    /**
     * Is number min of set.
     *
     * @param array $numbers Numbers set
     *
     * @return bool
     */
    public function isMin(array $numbers): bool
    {
        $final_array = $this->getValuesOfNumerable($numbers);
        sort($final_array);

        return $final_array[0] === $this->value;
    }

    /**
     * @inheritDoc
     */
    public function asInt(): int
    {
        return intval($this->value);
    }

    /**
     * @inheritDoc
     */
    public function asFloat(): float
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function asBool(): bool
    {
        return (bool)intval($this->value);
    }

    /**
     * @param array $numbers Numbers
     *
     * @return array
     */
    private function getValuesOfNumerable(array $numbers): array
    {
        $array = [];

        for ($i = 0; $i < count($numbers); $i++) {
            $array[] = floatval($numbers[$i]);
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::class;
    }
}