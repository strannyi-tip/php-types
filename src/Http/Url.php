<?php

namespace StrannyiTip\PhpTypes\Http;

use StrannyiTip\PhpTypes\Collection\List\MutableStringList;
use StrannyiTip\PhpTypes\Collection\UrlParametersContainer;
use StrannyiTip\PhpTypes\MutableString;

/**
 * Url.
 */
class Url extends MutableString
{
    /**
     * Last ::match matches.
     *
     * @var MutableStringList
     */
    private MutableStringList $last_matches;

    /**
     * Scheme.
     *
     * @var string
     */
    private(set) string $scheme = 'http';

    /**
     * Host.
     *
     * @var string
     */
    private(set) string $host = '';

    /**
     * Port.
     *
     * @var int
     */
    private(set) int $port = 0;

    /**
     * User.
     *
     * @var string
     */
    private(set) string $user = '';

    /**
     * Password.
     *
     * @var string
     */
    private(set) string $password = '';

    /**
     * Path.
     *
     * @var string
     */
    private(set) string $path = '';

    /**
     * Query.
     *
     * @var string
     */
    private(set) string $query = '';

    /**
     * Fragment.
     *
     * @var string
     */
    private(set) string $fragment;

    /**
     * Url query params.
     *
     * @var UrlParametersContainer
     */
    private(set) UrlParametersContainer $params {
        get => $this->params;
    }

    /**
     * Url.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->on_update = fn($obj) => $obj->build();
        parent::__construct($url);
    }

    /**
     * Is match pattern.
     *
     * @param string $pattern Needle pattern
     *
     * @return bool
     */
    public function match(string $pattern): bool
    {
        $matches = [];
        preg_match("~$pattern~", $this->value, $matches);
        foreach ($matches as $match) {
            $this->last_matches->append(new MutableString($match));
        }

        return count($matches) > 0;
    }

    /**
     * Get last ::match matches.
     *
     * @return MutableStringList
     */
    public function matches(): MutableStringList
    {
        return $this->last_matches;
    }

    /**
     * Build.
     *
     * @return void
     */
    private function build(): void
    {
        $this->last_matches = new MutableStringList();
        $parsed_url = parse_url($this->value);
        $this->scheme = $parsed_url['scheme'] ?? '';
        $this->host = $parsed_url['host'] ?? '';
        $this->port = $parsed_url['port'] ?? 0;
        $this->user = $parsed_url['user'] ?? '';
        $this->password = $parsed_url['pass'] ?? '';
        $this->path = $parsed_url['path'] ?? '';
        $this->query = $parsed_url['query'] ?? '';
        $this->fragment = $parsed_url['fragment'] ?? '';
        parse_str($this->query, $params);
        $this->params = new UrlParametersContainer($params);
    }
}