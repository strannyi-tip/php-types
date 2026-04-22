<?php

namespace StrannyiTip\PhpTypes\Component;

use Override;
use StrannyiTip\PhpTypes\Base\AbstractFactory;
use StrannyiTip\PhpTypes\Primitive\MutableRectangle;

class MutableRectangleFactory extends AbstractFactory
{

    /**
     * @inheritDoc
     */
    #[Override]
    public static function create(int $count, int $start = 0): array
    {
        $result_array = [];
        for ($iterator = 0; $iterator < $count; $iterator++) {
            $result_array[] = new MutableRectangle($start + $iterator, 0, 0, 0);
        }

        return $result_array;
    }
}