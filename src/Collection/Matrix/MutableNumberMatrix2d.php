<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\MutableNumber;

/**
 * 2d matrix for MutableNumber`s.
 */
class MutableNumberMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): MutableNumber|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof MutableNumber) {
            throw new InvalidArgumentException('Support MutableNumber type only');
        }

        return parent::set($x, $y, $value);
    }
}
