<?php

namespace BauRo\Zendesk\ApiClient\Service;

use Exception;

/**
 * Class ZendeskRequester
 * @package BauRo\Zendesk\ApiClient\Service
 */
class ZendeskRequester
{

    /**
     * @var ZendeskConnector
     */
    protected $connector;

    /**
     * @param ZendeskConnector $connector
     */
    public function __construct(ZendeskConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param $url
     * @return mixed
     * @throws Exception
     */
    protected function get($url)
    {
        return $this->connector->retrieveRequest($url);
    }

    /**
     * @param $url
     * @param $int
     * @return string json
     * @throws Exception
     */
    protected function getWithInt($url, $int)
    {
        if (!is_int($int)) {
            throw new Exception('The input data should be a integer');
        }
        return $this->connector->retrieveRequest($url);
    }

    /**
     * @param $url
     * @param $array
     * @return string json
     * @throws Exception
     */
    protected function postWithArray($url, $array)
    {
        if (!is_array($array)) {
            throw new Exception('The input data should be a array');
        }
        return $this->connector->postRequest($url, $array);
    }
}
