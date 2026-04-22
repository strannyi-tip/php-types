<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\Primitive\MutableRectangle;

/**
 * 2d matrix of MutableRectangle`s.
 */
class MutableRectangleMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): MutableRectangle|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof MutableRectangle) {
            throw new InvalidArgumentException('Support MutableRectangle type only');
        }

        return parent::set($x, $y, $value);
    }
}
