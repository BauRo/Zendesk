<?php

namespace BauRo\Zendesk\ApiClient\Tests;

use BauRo\Zendesk\ApiClient\Service\ZendeskConnector;
use BauRo\Zendesk\ApiClient\Requester\Satisfaction;

/**
 * Class SatisfactionRequesterTest
 * @package BauRo\Zendesk\ApiClient\Tests
 */
class SatisfactionRequesterTest extends \PHPUnit_Framework_TestCase
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

    public function testRetrieveTicketList()
    {
        $satisfactionRequester = new Satisfaction($this->connector);
        $array = $satisfactionRequester->getSatisfactionList();

        $this->assertArrayHasKey('satisfaction_ratings', $array);
    }

    public function testRetrieveSatisfactionListWithPageId()
    {
        $satisfactionRequester = new Satisfaction($this->connector);
        $json = $satisfactionRequester->getSatisfactionList(1);

        $this->assertArrayHasKey('satisfaction_ratings', $json);
    }

    public function testRetrieveSatisfactionListWithWrongPageId()
    {
        $satisfactionRequester = new Satisfaction($this->connector);
        try {
            $satisfactionRequester->getSatisfactionList('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a integer", $e->getMessage());
        }
    }

    public function testGetSatisfactionWithId()
    {
        $satisfactionRequester = new Satisfaction($this->connector);
        $json = $satisfactionRequester->getSatisfaction(147238422);

        $this->assertArrayHasKey('satisfaction_rating', $json);
    }

    public function testGetSatisfactionWithWrongSatisfactionId()
    {
        $satisfactionRequester = new Satisfaction($this->connector);
        try {
            $satisfactionRequester->getSatisfaction('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a integer", $e->getMessage());
        }
    }
}
