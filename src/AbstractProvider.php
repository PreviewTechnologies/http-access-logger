<?php

namespace Previewtechs\HTTP\AccessLogger;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractProvider
 * @package Previewtechs\API\AccessLogger
 */
abstract class AbstractProvider
{
    /**
     * @var ServerRequestInterface
     */
    public $request;

    /**
     * @return string
     */
    public function getIP()
    {
        return $this->request->getServerParams()['REMOTE_ADDR'];
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->request->getUri()->getPath();
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->request->getMethod();
    }

    /**
     * @return string|null
     */
    public function getVersion()
    {
        preg_match("/\/v[0-9]\//", $this->request->getUri(), $match);
        return str_replace('/', '', $match[0]);
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return new \DateTime('now');
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            'method' => $this->getMethod(),
            'endpoint' => $this->getEndpoint(),
            'version' => $this->getVersion(),
            'request_ip' => $this->getIP(),
            'created' => $this->getCreated()
        ];
    }
}