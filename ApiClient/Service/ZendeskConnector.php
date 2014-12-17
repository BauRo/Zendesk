<?php

namespace BauRo\Zendesk\ApiClient\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;

/**
 * Class ZendeskConnector
 * @package BauRo\Zendesk\ApiClient\Service
 */
class ZendeskConnector
{
    private $api_url;
    private $api_user;
    private $api_key;

    /**
     * @param $api_url
     * @param $api_user
     * @param $api_key
     */
    public function __construct(
        $api_url,
        $api_user,
        $api_key
    ) {
        $this->api_url = $api_url;
        $this->api_user = $api_user;
        $this->api_key = $api_key;
    }

    /**
     * @return Client
     */
    public function connect()
    {
        $client = new Client(
            ['base_url' => $this->api_url,
                'defaults' => [
                    'config' => [
                        'curl' => [
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_USERPWD => $this->api_user . '/token:' . $this->api_key
                        ]
                    ]
                ]
            ]
        );
        return $client;
    }

    /**
     * @param $request
     * @return mixed
     * @throws Exception
     */
    public function retrieveRequest($request)
    {
        $client = $this->connect();
        try {
            $response = $client->get($request);
            return $response->json();
        } catch (RequestException $e) {
            throw new Exception('The request to Zendesk cant be completed.', $e->getCode());
        }
    }

    /**
     * @param $request
     * @param $data
     * @throws Exception
     */
    public function postRequest($request, $data)
    {
        $client = $this->connect();
        try {
            $response = $client->post($request, ['json' => $data]);
            return $response->json();
        } catch (RequestException $e) {
            throw new Exception('The request to Zendesk cant be completed.', $e->getCode());
        }
    }
}
