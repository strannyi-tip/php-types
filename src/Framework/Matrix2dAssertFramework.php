<?php

namespace StrannyiTip\PhpTypes\Framework;

use Codeception\Test\Unit;
use Override;
use StrannyiTip\PhpTypes\Base\AbstractMatrix2d;
use StrannyiTip\PhpTypes\Base\AssertFramework;

class Matrix2dAssertFramework extends AssertFramework
{
    /**
     * Instance.
     *
     * @var mixed
     */
    private static mixed $instance = null;

    /**
     * Initializing method.
     *
     * @param Unit $tester Tester
     *
     * @return mixed
     */
    public static function useTester(Unit $tester): Matrix2dAssertFramework
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        self::$tester = $tester;

        return self::$instance;
    }

    public function assertCreateSetHasGet(string $matrix_class, string $type_factory): Matrix2dAssertFramework
    {
        /**
         * @var AbstractMatrix2d $matrix
         */
        $matrix = new $matrix_class();
        $items = $type_factory::create(3);
        $matrix
            ->set(0, 0, $items[0])
            ->set(0, 1, $items[1])
            ->set(1, 0, $items[2]);
        self::$tester
            ->assertTrue($matrix->has(0, 0), 'Assert isset item 0 0');
        self::$tester
            ->assertTrue($matrix->has(0, 1), 'Assert isset item 0 1');
        self::$tester
            ->assertTrue($matrix->has(1, 0), 'Assert isset item 1 0');
        self::$tester
            ->assertEquals($items[0], $matrix->get(0, 0), 'Assert get item 0 0');
        self::$tester
            ->assertEquals($items[1], $matrix->get(0, 1), 'Assert get item 0 1');
        self::$tester
            ->assertEquals($items[2], $matrix->get(1, 0), 'Assert get item 1 0');

        return $this;
    }

    public function assertCounts(string $matrix_class, string $type_factory): Matrix2dAssertFramework
    {
        /**
         * @var AbstractMatrix2d $matrix
         */
        $matrix = new $matrix_class();
        $items = $type_factory::create(3);
        $matrix
            ->set(0, 0, $items[0])
            ->set(0, 1, $items[1])
            ->set(1, 0, $items[2]);
        self::$tester
            ->assertEquals(2, $matrix->countX(), 'Assert countX lvl counts');
        self::$tester
            ->assertEquals(3, $matrix->count(), 'Assert count all counts');

        return $this;
    }
}
