<?php

namespace Previewtechs\HTTP\AccessLogger;


use Psr\Http\Message\ServerRequestInterface;

class AccessLog extends AbstractProvider
{
    protected $storage;
    public $request;

    public function __construct(ServerRequestInterface $request, StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->request = $request;
    }

    public function getData()
    {
        return parent::getData();
    }

    public function record()
    {
        return $this->storage->save($this->getData());
    }
}