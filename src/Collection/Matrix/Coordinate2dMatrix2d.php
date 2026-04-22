<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\Wrapper\Coordinate2d;

/**
 * 2d matrix fpr Coordinate2d`s.
 */
class Coordinate2dMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): Coordinate2d|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof Coordinate2d) {
            throw new InvalidArgumentException('Support Coordinate2d type only');
        }

        return parent::set($x, $y, $value);
    }
}
