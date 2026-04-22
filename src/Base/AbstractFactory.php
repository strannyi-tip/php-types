<?php

namespace StrannyiTip\PhpTypes\Base;

/**
 * Abstract factory.
 */
abstract class AbstractFactory
{
    /**
     * Create Vector2String instances.
     *
     * @param int $count Objects count
     * @param int $start Start number value
     *
     * @return array
     */
    public abstract static function create(int $count, int $start = 0): array;
}
