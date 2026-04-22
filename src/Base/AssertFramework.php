<?php

namespace StrannyiTip\PhpTypes\Base;

use Codeception\Test\Unit;

class AssertFramework
{
    /**
     * Tester instance.
     *
     * @var Unit|null
     */
    protected static ?Unit $tester = null;

    /**
     * Close constructor.
     */
    protected function __construct(){}
}
