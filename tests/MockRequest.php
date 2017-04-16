<?php

namespace Previewtechs\HTTP\AccessLogger\Tests;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Write something about the purpose of this file
 *
 * @author Shaharia Azam <shaharia@previewtechs.com>
 * @url https://www.previewtechs.com
 */
class MockRequest
{
    /**
     * @var ServerRequestInterface
     */
    protected $mock;
    protected $serverParams = [];

    protected $request;

    /**
     * MockRequest constructor.
     */
    public function __construct()
    {
        $this->mock = \Mockery::mock('\Psr\Http\Message\ServerRequestInterface');

        $this->serverParams = [
            'REMOTE_ADDR' => '127.0.0.1'
        ];
    }

    /**
     *
     */
    public function buildRequest()
    {
        $mockUri = \Mockery::mock('\Psr\Http\MessageUriInterface\UriInterface');
        $mockUri->shouldReceive('getPath')
            ->andReturn('/v1/me');

        $this->mock->shouldReceive('getServerParams')
            ->andReturn($this->serverParams);

        $this->mock->shouldReceive('getMethod')
            ->andReturn('GET');

        $this->mock->shouldReceive('getData');

        $this->mock->shouldReceive('getUri')
            ->andReturn($mockUri);
    }

    /**
     * @return ServerRequestInterface
     */
    public function getMockRequest()
    {
        $this->buildRequest();
        return $this->mock;
    }
}
