<?php

namespace StrannyiTip\PhpTypes\Component;

use Override;
use StrannyiTip\PhpTypes\Base\AbstractFactory;
use StrannyiTip\PhpTypes\MutableNumber;

/**
 * MutableNumber factory.
 */
class MutableNumberFactory extends AbstractFactory
{
    /**
     * @inheritDoc
     */
    #[Override]
    public static function create(int $count, int $start = 0): array
    {
        $result_array = [];
        for ($iterator = 0; $iterator < $count; $iterator++) {
            $result_array[] = new MutableNumber($start + $iterator);
        }

        return $result_array;
    }
}