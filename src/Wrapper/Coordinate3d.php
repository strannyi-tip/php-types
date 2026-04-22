<?php

namespace StrannyiTip\PhpTypes\Wrapper;

use Serializable;
use StrannyiTip\PhpTypes\Interfaces\ExtendedTypeInterface;
use Stringable;
use StrannyiTip\PhpTypes\MutableNumber;


/**
 * 3d coordinates.
 */
class Coordinate3d implements Stringable, Serializable, ExtendedTypeInterface
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
     * Z.
     *
     * @var int|float|MutableNumber
     */
    private(set) MutableNumber|int|float $z {
        set {
            $this->z = new MutableNumber($value);
        }
        get {
            return $this->z;
        }
    }

    /**
     * 3d Coordinates.
     *
     * @param MutableNumber|int|float $x X coordinate
     * @param MutableNumber|int|float $y Y coordinate
     * @param MutableNumber|int|float $z Z coordinate
     */
    public function __construct(MutableNumber|int|float $x = 0, MutableNumber|int|float $y = 0, MutableNumber|int|float $z = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return json_encode([
            'x' => $this->x->value,
            'y' => $this->y->value,
            'z' => $this->z->value,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return json_encode([
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
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
        $this->z = $json['z'];
    }

    public function __serialize(): array
    {
        return [
            'x' => $this->x->value,
            'y' => $this->y->value,
            'z' => $this->z->value,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->x = $data['x'];
        $this->y = $data['y'];
        $this->z = $data['z'];
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::class;
    }
}