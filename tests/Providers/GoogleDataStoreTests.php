<?php
/**
 * Write something about the purpose of this file
 *
 * @author Shaharia Azam <shaharia@previewtechs.com>
 * @url https://www.previewtechs.com
 */

namespace Previewtechs\HTTP\AccessLogger\Tests\Providers;

use GDS\Entity;
use PHPUnit\Framework\TestCase;
use Previewtechs\HTTP\AccessLogger\Providers\GoogleDataStore;
use Previewtechs\HTTP\AccessLogger\StorageInterface;
use Previewtechs\HTTP\AccessLogger\Tests\MockStorage;

class GoogleDataStoreTests extends TestCase
{
    /**
     * @var GoogleDataStore
     */
    protected $datastore;
    protected $mockGds;

    public function setUp()
    {
        $this->mockGds = \Mockery::mock('GDS\Store\Store');
        $this->mockGds->shouldReceive('createEntity')
            ->andReturn(new Entity());
        $this->mockGds->shouldReceive('upsert')
            ->andReturnNull();
        $this->datastore = new GoogleDataStore($this->mockGds);
    }

    public function testInterfaceCompatibility()
    {
        $this->assertTrue($this->datastore instanceof StorageInterface);
    }

    public function testDataCheck()
    {
        $this->assertTrue(is_array($this->datastore->data));
        $this->assertTrue(is_array($this->datastore->getData()));
    }

    public function testStore()
    {
        $this->datastore->data = [];
        $this->assertEmpty($this->datastore->save(['testKey' => 'testValue']));
    }
}
