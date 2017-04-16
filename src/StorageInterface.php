<?php

namespace Previewtechs\HTTP\AccessLogger;

interface StorageInterface
{
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