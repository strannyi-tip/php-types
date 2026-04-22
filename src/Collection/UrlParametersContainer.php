<?php

namespace StrannyiTip\PhpTypes\Collection;


/**
 * Url parameters container.
 */
class UrlParametersContainer
{
    /**
     * Container.
     *
     * @var array
     */
    private array $container = [];

    /**
     * Url parameters container.
     *
     * @param array $container Parsed url query container
     */
    public function __construct(array $container)
    {
        $this->container = $container;
    }

    /**
     * Is has param.
     *
     * @param string $param Needle param
     *
     * @return bool
     */
    public function has(string $param): bool
    {
        return isset($this->container[$param]);
    }

    /**
     * Get.
     *
     * @param string $param Needle param
     * @param mixed $default Default value
     *
     * @return string|null
     */
    public function get(string $param, mixed $default = null): ?string
    {
        return $this->has($param) ? $this->container[$param] : $default;
    }
}