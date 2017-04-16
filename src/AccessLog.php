<?php

namespace Previewtechs\HTTP\AccessLogger;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AccessLog
 * @package Previewtechs\HTTP\AccessLogger
 */
class AccessLog extends AbstractProvider
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var ServerRequestInterface
     */
    public $request;

    /**
     * @var array
     */
    public $data = [];

    /**
     * @var LoggerInterface $logger
     */
    public $logger;

    /**
     * AccessLog constructor.
     * @param ServerRequestInterface $request
     * @param StorageInterface $storage
     */
    public function __construct(ServerRequestInterface $request, StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->request = $request;

        $this->data = parent::getData();
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function record()
    {
        try {
            return $this->storage->save($this->data);
            // @codeCoverageIgnoreStart
        } catch (\Exception $exception) {
            $this->logger ? $this->logger->error($exception->getMessage()) : false;
            $this->logger ? $this->logger->debug($exception->getTraceAsString()) : false;

            return false;
        }
            // @codeCoverageIgnoreStart
    }
}
