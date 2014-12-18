<?php

namespace BauRo\Zendesk\ApiClient\Requester;

use \Exception;
use BauRo\Zendesk\ApiClient\Service\ZendeskRequester;

/**
 * Class Ticket
 * @package BauRo\Zendesk\ApiClient\Requester
 */
class Ticket extends ZendeskRequester
{

    /**
     * @param  int $page
     * @return string json
     * @throws \Exception
     */
    public function getTicketList($page = 1)
    {
        return $this->getWithInt(
            '/api/v2/tickets.json?page=' . $page,
            $page
        );
    }

    /**
     * @param int $ticketId
     * @return string json
     * @throws Exception
     */
    public function getTicket($ticketId)
    {
        return $this->getWithInt(
            '/api/v2/tickets/' . $ticketId . '.json',
            $ticketId
        );
    }

    /**
     * @param array $ticketArray
     * @return string json
     * @throws Exception
     */
    public function getTickets($ticketArray)
    {
        return $this->postWithArray(
            '/api/v2/tickets/show_many.json',
            $ticketArray
        );
    }

    /**
     * @param int $userId
     * @return string json
     * @throws Exception
     */
    public function getRequestedTicketsByUserId($userId)
    {
        return $this->getWithInt(
            '/api/v2/users/' . $userId . '/tickets/requested.json',
            $userId
        );
    }
}
