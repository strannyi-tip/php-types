<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\Wrapper\Vector2String;

/**
 * 2d matrix of Vector2String`s.
 */
class Vector2StringMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): Vector2String|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof Vector2String) {
            throw new InvalidArgumentException('Support Vector2String type only');
        }

        return parent::set($x, $y, $value);
    }
}
