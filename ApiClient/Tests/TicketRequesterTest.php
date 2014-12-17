<?php

namespace BauRo\Zendesk\ApiClient\Tests;

use BauRo\Zendesk\ApiClient\Service\ZendeskConnector;
use BauRo\Zendesk\ApiClient\Requester\Ticket;

/**
 * Class TicketRequesterTest
 * @package BauRo\Zendesk\ApiClient\Tests
 */
class TicketRequesterTest extends \PHPUnit_Framework_TestCase
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
        $ticketRequester = new Ticket($this->connector);
        $array = $ticketRequester->getTicketList();

        $this->assertArrayHasKey('tickets', $array);
    }

    public function testRetrieveTicketListWithPageId()
    {
        $ticketRequester = new Ticket($this->connector);
        $json = $ticketRequester->getTicketList(1);

        $this->assertArrayHasKey('tickets', $json);
    }

    public function testRetrieveTicketListWithWrongPageId()
    {
        $ticketRequester = new Ticket($this->connector);
        try {
            $ticketRequester->getTicketList('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a integer", $e->getMessage());
        }
    }

    public function testGetTicketWithId()
    {
        $ticketRequester = new Ticket($this->connector);
        $json = $ticketRequester->getTicket(95102);

        $this->assertArrayHasKey('ticket', $json);
    }

    public function testGetTicketWithWrongTicketId()
    {
        $ticketRequester = new Ticket($this->connector);
        try {
            $ticketRequester->getTicket('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a integer", $e->getMessage());
        }
    }

    public function testRetrieveTicketsFromGivenArray()
    {
        $ticketArray = array(
            0 => 0001,
            1 => 0002,
            2 => 0003
        );
        $ticketRequester = new Ticket($this->connector);
        $json = $ticketRequester->getTickets($ticketArray);
        $this->assertArrayHasKey('tickets', $json);
    }

    public function testRetrieveTicketsFromGivenArrayWithWrongInput()
    {
        $ticketRequester = new Ticket($this->connector);
        try {
            $ticketRequester->getTickets('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a array", $e->getMessage());
        }
    }

    public function testGetUserTicketWithId()
    {
        $ticketRequester = new Ticket($this->connector);
        $json = $ticketRequester->getRequestedTicketsByUserId(447106337);

        $this->assertArrayHasKey('tickets', $json);
    }

    public function testGetUserTicketWithWrongUserId()
    {
        $ticketRequester = new Ticket($this->connector);
        try {
            $ticketRequester->getRequestedTicketsByUserId('string');
            $this->fail("Expected exception not thrown");
        } catch (\Exception $e) {
            $this->assertEquals("The input data should be a integer", $e->getMessage());
        }
    }
}
