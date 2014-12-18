<?php

namespace BauRo\Zendesk\ApiClient\Requester;

use \Exception;
use BauRo\Zendesk\ApiClient\Service\ZendeskRequester;

/**
 * Class Satisfaction
 * @package BauRo\Zendesk\ApiClient\Requester
 */
class Satisfaction extends ZendeskRequester
{

    /**
     * @param  int $page
     * @return string json
     * @throws \Exception
     */
    public function getSatisfactionList($page = 1)
    {
        return $this->getWithInt(
            '/api/v2/satisfaction_ratings.json?page=' . $page,
            $page
        );
    }

    /**
     * @param int $satisfactionId
     * @return string json
     * @throws Exception
     */
    public function getSatisfaction($satisfactionId)
    {
        return $this->getWithInt(
            '/api/v2/satisfaction_ratings/' . $satisfactionId . '.json',
            $satisfactionId
        );
    }
}
