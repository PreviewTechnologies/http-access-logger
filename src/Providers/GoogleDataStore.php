<?php

namespace Previewtechs\HTTP\AccessLogger\Providers;

use GDS\Store;
use Previewtechs\HTTP\AccessLogger\StorageInterface;

/**
 * Class GoogleDataStore
 * @package Previewtechs\HTTP\AccessLogger\Providers
 */
class GoogleDataStore implements StorageInterface
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @var Store $gds
     */
    private $gds;

    /**
     * GoogleDataStore constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->gds = $client;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save($data = [])
    {
        $this->data = $data;

        $entities = $this->gds->createEntity($this->data);
        return $this->gds->upsert($entities);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
