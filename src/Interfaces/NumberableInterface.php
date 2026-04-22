<?php

namespace StrannyiTip\PhpTypes\Interfaces;

interface NumberableInterface
{
    /**
     * Get as int.
     *
     * @return int
     */
    public function asInt(): int;

    /**
     * Get as float.
     *
     * @return float
     */
    public function asFloat(): float;

    /**
     * Get as boolean.
     *
     * @return bool
     */
    public function asBool(): bool;
}