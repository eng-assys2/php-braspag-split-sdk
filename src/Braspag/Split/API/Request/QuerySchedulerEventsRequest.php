<?php

namespace Braspag\Split\Api\Request;

use Braspag\Merchant;

use Braspag\Request\AbstractRequest;

use Braspag\Split\API\Environment;
use Braspag\Split\API\SchedulerQuery;
use Braspag\Split\API\SchedulerQueryResponse;

/**
 * Class QuerySchedulerEventsRequest
 *
 * @package Braspag\Split\Api\Request
 */
class QuerySchedulerEventsRequest extends AbstractRequest
{

    private $environment;

    /**
     * QuerySchedulerEventsRequest constructor.
     *
     * @param Merchant    $merchant
     * @param Environment $environment
     */
    public function __construct(Merchant $merchant, Environment $environment)
    {
        parent::__construct($merchant);

        $this->environment = $environment;
    }

    /**
     * @param $schedulerQuery
     *
     * @return null
     * @throws \Braspag\API\Request\BraspagRequestException
     */
    public function execute($schedulerQuery)
    {
        $url = $this->environment->getApiUrl() . 'schedule-api/events?' . $schedulerQuery->getQueryParams();

        return $this->sendRequest('GET', $url);
    }

    /**
     * @param $json
     *
     * @return SchedulerQueryResponse
     */
    protected function unserialize($json)
    {
        return SchedulerQueryResponse::fromJson($json);
    }

}
