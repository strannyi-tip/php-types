<?php

namespace StrannyiTip\PhpTypes\Collection\Matrix;


use http\Exception\InvalidArgumentException;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\Http\File;

/**
 * 2d matrix of File`s.
 */
class FileMatrix2d extends AbstractMatrix2d
{
    /**
     * @inheritDoc
     */
    #[Override]
    public function get(int $x, int $y): File|string
    {
        return $this->has($x, $y) ? $this->container[$x][$y] : '';
    }

    /**
     * @inheritDoc
     */
    #[Override]
    public function set(int $x, int $y, mixed $value): AbstractMatrix2d
    {
        if (!$value instanceof File) {
            throw new InvalidArgumentException('Support File type only');
        }

        return parent::set($x, $y, $value);
    }
}
