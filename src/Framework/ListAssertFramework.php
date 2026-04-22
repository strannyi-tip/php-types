<?php

namespace StrannyiTip\PhpTypes\Framework;

use Codeception\Test\Unit;
use JetBrains\PhpStorm\NoReturn;
use StrannyiTip\PhpTypes\Base\AssertFramework;

class ListAssertFramework extends AssertFramework
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
    public static function useTester(Unit $tester): ListAssertFramework
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        self::$tester = $tester;

        return self::$instance;
    }

    /**
     * Creating.
     *
     * @param string $list_class List class name
     * @param string $factory_class Factory class
     * @param string $type_class Contains one class
     *
     * @return ListAssertFramework
     */
    public function assertsCreating(string $list_class, string $factory_class, string $type_class): ListAssertFramework
    {
        $list_with_sets_of_construct = new $list_class($factory_class::create(3));
        $list_with_appends = new $list_class()
            ->append(new $type_class(0))
            ->append(new $type_class(1))
            ->append(new $type_class(2));
        $list_with_key_access = new $list_class();
        $list_with_key_access[0] = new $type_class(0);
        $list_with_key_access[1] = new $type_class(1);
        $list_with_key_access[2] = new $type_class(2);
        self::$tester->assertEquals($list_with_sets_of_construct, $list_with_appends, 'Test for create methods build equals objects | construct-appends');
        self::$tester->assertEquals($list_with_sets_of_construct, $list_with_key_access, 'Test for create methods build equals objects | construct-key-access');

        return $this;
    }

    /**
     * Clear method.
     *
     * @param string $list_class List class name
     * @param string $factory_class Factory class
     *
     * @return ListAssertFramework
     */
    public function assertsClearMethod(string $list_class, string $factory_class): ListAssertFramework
    {
        $list = new $list_class($factory_class::create(3));
        self::$tester->assertCount(3, $list, 'Test for check contains 3 count before clearing');
        $list->clear();
        self::$tester->assertCount(0, $list, 'Test for check contains 0 count after clearing');

        return $this;
    }

    /**
     * Merge method.
     *
     * @param string $list_class List class name
     * @param string $factory_class Factory class
     *
     * @return ListAssertFramework
     */
    #[NoReturn]
    public function assertsMergeMethod(string $list_class, string $factory_class): ListAssertFramework
    {
        $list_a = new $list_class($factory_class::create(3));
        $list_b = new $list_class($factory_class::create(3, 3));
        $merged_list = $list_a->merge($list_b);
        self::$tester->assertEquals(new $list_class($factory_class::create(6)), $merged_list, 'Test for merge work correctly');

        return $this;
    }
}