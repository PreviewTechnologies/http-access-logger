<?php

namespace Previewtechs\HTTP\AccessLogger;

/**
 * Interface StorageInterface
 * @package Previewtechs\HTTP\AccessLogger
 */
interface StorageInterface
{
    /**
     * StorageInterface constructor.
     * @param $client
     */
    public function __construct($client);

    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     * @return mixed
     */
    public function save($data = []);
}
