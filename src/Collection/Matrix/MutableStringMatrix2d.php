<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\MutableString;

/**
 * 2d matrix of MutableString`s.
 */
class MutableStringMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): MutableString|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof MutableString) {
            throw new InvalidArgumentException('Support MutableString type only');
        }

        return parent::set($x, $y, $value);
    }
}
