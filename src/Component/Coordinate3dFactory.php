<?php

namespace StrannyiTip\PhpTypes\Component;


use Override;
use StrannyiTip\PhpTypes\Base\AbstractFactory;
use StrannyiTip\PhpTypes\Wrapper\Coordinate3d;

class Coordinate3dFactory extends AbstractFactory
{
    /**
     * @inheritDoc
     */
    #[Override]
    public static function create(int $count, int $start = 0): array
    {
        $result_array = [];
        for ($iterator = 0; $iterator < $count; $iterator++) {
            $result_array[] = new Coordinate3d($start + $iterator, 0, 0);
        }

        return $result_array;
    }
}