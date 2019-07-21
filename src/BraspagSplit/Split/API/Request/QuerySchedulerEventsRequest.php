<?php

namespace BraspagSplit\Split\Api\Request;

use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Split\API\Environment;
use BraspagSplit\Split\API\SchedulerQuery;
use BraspagSplit\Split\API\SchedulerQueryResponse;

/**
 * Class QuerySchedulerEventsRequest
 *
 * @package BraspagSplit\Split\Api\Request
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
     * @throws \BraspagSplit\API\Request\BraspagRequestException
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