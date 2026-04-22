<?php

namespace StrannyiTip\PhpTypes\Wrapper;

use Serializable;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use StrannyiTip\PhpTypes\MutableNumber;
use Stringable;

/**
 * 2d coordinates.
 */
class Coordinate2d implements Stringable, Serializable, ExtendedTypeInterface
{
    /**
     * X.
     *
     * @var int|float|MutableNumber
     */
    private(set) MutableNumber|int|float $x {
        set {
            $this->x = new MutableNumber($value);
        }
        get {
            return $this->x;
        }
    }

    /**
     * Y.
     *
     * @var int|float|MutableNumber
     */
    private(set) MutableNumber|int|float $y {
        set {
            $this->y = new MutableNumber($value);
        }
        get {
            return $this->y;
        }
    }

    /**
     * 2d Coordinates.
     *
     * @param MutableNumber|int|float $x X coordinate
     * @param MutableNumber|int|float $y Y coordinate
     */
    public function __construct(MutableNumber|int|float $x = 0, MutableNumber|int|float $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return json_encode([
            'x' => $this->x->value,
            'y' => $this->y->value,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return json_encode([
            'x' => $this->x->value,
            'y' => $this->y->value,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $data): void
    {
        $json = json_decode($data);

        $this->x = $json['x'];
        $this->y = $json['y'];
    }

    public function __serialize(): array
    {
        return [
            'x' => $this->x->value,
            'y' => $this->y->value,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->x = $data['x'];
        $this->y = $data['y'];
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::class;
    }
}