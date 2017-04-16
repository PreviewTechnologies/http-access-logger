<?php

namespace Previewtechs\HTTP\AccessLogger\Tests;

use Previewtechs\HTTP\AccessLogger\AccessLog;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Write something about the purpose of this file
 *
 * @author Shaharia Azam <shaharia@previewtechs.com>
 * @url https://www.previewtechs.com
 */
class AccessLogTests extends \PHPUnit\Framework\TestCase
{
    protected $mockRequest;
    protected $mockStorage;

    /**
     * @var AccessLog
     */
    protected $accessLogger;

    public function setUp()
    {
        $request = new MockRequest();
        $this->mockRequest = $request->getMockRequest();

        $request = new MockStorage();
        $this->mockStorage = $request->getMockStorage();

        $this->accessLogger = new AccessLog($this->mockRequest, $this->mockStorage);
    }

    public function tearDown()
    {
        unset($this->mockStorage);
        unset($this->mockRequest);
    }

    public function testLoggerIntegration()
    {
        $this->accessLogger->setLogger(new NullLogger());
        $this->assertTrue($this->accessLogger->logger instanceof LoggerInterface);
    }

    public function testGetDataArray()
    {
        $this->assertArrayHasKey('method', $this->accessLogger->getData());
        $this->assertArrayHasKey('endpoint', $this->accessLogger->getData());
        $this->assertArrayHasKey('version', $this->accessLogger->getData());
        $this->assertArrayHasKey('request_ip', $this->accessLogger->getData());
        $this->assertTrue($this->accessLogger->getData()['created'] instanceof \DateTime);
    }

    public function testAddAdditionalKeyValueInDataset()
    {
        $this->accessLogger->add('key', 'value');
        $this->assertArrayHasKey('key', $this->accessLogger->getData());
    }

    public function testAddRecordToDataStorage()
    {
        $this->assertNull($this->accessLogger->record());
    }


    public function testAddRecordStorageIfFailed()
    {
        $mockAccessLoger = \Mockery::mock($this->accessLogger);
        $mockAccessLoger->shouldReceive('record')
            ->andReturn(false);
        $this->assertFalse($mockAccessLoger->record());
    }
}
