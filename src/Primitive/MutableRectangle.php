<?php

namespace StrannyiTip\PhpTypes\Primitive;

use Serializable;
use Stringable;
use StrannyiTip\PhpTypes\Enumeration\OrientationEnum;
use StrannyiTip\PhpTypes\MutableNumber;

/**
 * Rectangle.
 */
class MutableRectangle implements Stringable, Serializable
{
    /**
     * X.
     *
     * @var float
     */
    private(set) float $x {
        get {
            return $this->x;
        }
        set {
            $this->x = $value;
        }
    }

    /**
     * Y.
     *
     * @var float
     */
    private(set) float $y {
        get {
            return $this->y;
        }
        set {
            $this->y = $value;
        }
    }

    /**
     * Width.
     *
     * @var float
     */
    private(set) float $width {
        get {
            return $this->width;
        }
        set {
            $this->width = $value;
        }
    }

    /**
     * Height.
     *
     * @var float
     */
    private(set) float $height {
        get {
            return $this->height;
        }
        set {
            $this->height = $value;
        }
    }

    /**
     * Rectangle.
     *
     * @param MutableNumber|int|float|string $x X coordinate
     * @param MutableNumber|int|float|string $y Y coordinate
     * @param MutableNumber|int|float|string $width Width
     * @param MutableNumber|int|float|string $height Height
     */
    public function __construct(
        MutableNumber|int|float|string $x = 0,
        MutableNumber|int|float|string $y = 0,
        MutableNumber|int|float|string $width = 0,
        MutableNumber|int|float|string $height = 0
    )
    {
        $this->x = $x instanceof MutableNumber ? floatval($x->value) : floatval($x);
        $this->y = $y instanceof MutableNumber ? floatval($y->value) : floatval($y);
        $this->width = $width instanceof MutableNumber ? floatval($width->value) : floatval($width);
        $this->height = $height instanceof MutableNumber ? floatval($height->value) : floatval($height);
    }

    /**
     * Get square.
     *
     * @return MutableNumber
     */
    public function square(): MutableNumber
    {
        return new MutableNumber($this->width * $this->height);
    }

    /**
     * @param int|float|MutableNumber $scale Scale points
     *
     * @return MutableRectangle
     */
    public function zoom(int|float|MutableNumber $scale): MutableRectangle
    {
        $scale_number = floatval($scale instanceof MutableNumber ? $scale->value : $scale);
        if ($scale_number === 0.0) {
            return $this;
        }
        $this->width = ($this->width * $scale_number / 100) * 100;
        $this->height = ($this->height * $scale_number / 100) * 100;

        return $this;
    }

    /**
     * Get orientation.
     *
     * @return OrientationEnum
     */
    public function orientation(): OrientationEnum
    {
        if ($this->width === $this->height) {
            return OrientationEnum::Square;
        }

        return $this->width > $this->height ? OrientationEnum::Landscape : OrientationEnum::Portrait;
    }

    /**
     * Is rectangle contains some rectangle.
     *
     * @param MutableRectangle $rect Some rectangle
     *
     * @return bool
     */
    public function contains(MutableRectangle $rect): bool
    {
        $is_x_left = $this->x <= $rect->x;
        $is_width_complete = $this->x + $this->width >= $rect->x + $rect->width;
        $is_y_top = $this->y <= $rect->y;
        $is_height_complete = $this->y + $this->height >= $rect->y + $rect->height;

        return
            $is_x_left &&
            $is_width_complete &&
            $is_y_top &&
            $is_height_complete;
    }

    /**
     * Is has collision with some rectangle.
     *
     * @param MutableRectangle $rect Some rectangle
     *
     * @return bool
     */
    public function hasCollision(MutableRectangle $rect): bool
    {
        return (
            $this->x < $rect->x + $rect->width &&
            $this->x + $this->width > $rect->x &&
            $this->y < $rect->y + $rect->height &&
            $this->y + $this->height > $rect->y
        );
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return json_encode([
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
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
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $data): void
    {
        $associative = json_decode($data);
        $this->x = floatval($associative['x']);
        $this->y = floatval($associative['y']);
        $this->width = floatval($associative['width']);
        $this->height = floatval($associative['height']);
    }

    public function __serialize(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->x = floatval($data['x']);
        $this->y = floatval($data['y']);
        $this->width = floatval($data['width']);
        $this->height = floatval($data['height']);
    }
}