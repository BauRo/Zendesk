<?php

namespace BauRo\Zendesk\ApiClient\Tests;

use BauRo\Zendesk\ApiClient\Service\ZendeskConnector;

/**
 * Class ZendeskConnectorServiceTest
 * @package BauRo\Zendesk\ApiClient\Tests
 */
class ZendeskConnectorServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @Object ZendeskConnector
     */
    public $connector;

    protected function setUp()
    {
        $this->connector = new ZendeskConnector(
            getenv('API_URL'),
            getenv('API_USER'),
            getenv('API_PASS')
        );
    }

    public function testRetrieveRequestException()
    {
        try {
            $this->connector->retrieveRequest('not_existing');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The request to Zendesk cant be completed.", $e->getMessage());
        }
    }

    public function testPostRequestException()
    {
        try {
            $this->connector->postRequest('not_existing', array(0 => 1));
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The request to Zendesk cant be completed.", $e->getMessage());
        }
    }
}
