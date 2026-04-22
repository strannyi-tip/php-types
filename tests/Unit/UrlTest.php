<?php

namespace Unit;

use Codeception\Test\Unit;
use StrannyiTip\PhpTypes\Collection\List\MutableStringList;
use StrannyiTip\PhpTypes\Http\Url;
use StrannyiTip\PhpTypes\MutableString;


class UrlTest extends Unit
{
    public function testCreateAndParse()
    {
        $url = new Url('https://user:password@example.com:1080/path/index.php?foo=bar#all');
        $this->assertEquals('https', $url->scheme, 'Test `scheme` correctly');
        $this->assertEquals('user', $url->user, 'Test `user` correctly');
        $this->assertEquals('password', $url->password, 'Test `password` correctly');
        $this->assertEquals('example.com', $url->host, 'Test `host` correctly');
        $this->assertEquals(1080, $url->port, 'Test `port` correctly');
        $this->assertEquals('/path/index.php', $url->path, 'Test `path` correctly');
        $this->assertEquals('foo=bar', $url->query, 'Test `query` correctly');
        $this->assertEquals('all', $url->fragment, 'Test `fragment` correctly');
        $this->assertEquals('bar', $url->params->get('foo'), 'Test params sets correctly');
    }

    public function testMatchAndMatches()
    {
        $url = new Url('https://example.com/post/7');
        $this->assertFalse($url->match('https://example.com/\d+/\w+'));
        $this->assertTrue($url->match('https://example.com/(\w+)/(\d+)'));
        $this->assertEquals(new MutableStringList([
            new MutableString('https://example.com/post/7'),
            new MutableString('post'),
            new MutableString('7'),
        ]), $url->matches());
    }
}
