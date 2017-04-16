<?php
namespace Previewtechs\HTTP\AccessLogger\Tests;

use Previewtechs\HTTP\AccessLogger\StorageInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Write something about the purpose of this file
 *
 * @author Shaharia Azam <shaharia@previewtechs.com>
 * @url https://www.previewtechs.com
 */
class MockStorage
{
    /**
     * @var StorageInterface
     */
    protected $mock;

    protected $request;

    /**
     * MockRequest constructor.
     */
    public function __construct()
    {
        $this->mock = \Mockery::mock('Previewtechs\HTTP\AccessLogger\StorageInterface');
    }

    /**
     *
     */
    public function buildRequest()
    {
        $this->mock->shouldReceive('save');
        $this->mock->shouldReceive('getData');
    }

    /**
     * @return StorageInterface
     */
    public function getMockStorage()
    {
        $this->buildRequest();
        return $this->mock;
    }
}
