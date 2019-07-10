<?php

namespace Braspag\Split\Api\Request;

use Braspag\Merchant;

use Braspag\Request\AbstractRequest;

use Braspag\Split\API\SchedulerQuery;
use Braspag\Split\API\SchedulerQueryResponse;
use Braspag\Split\API\Environment;

/**
 * Class QuerySchedulerTransactionsRequest
 *
 * @package Braspag\Split\Api\Request
 */
class QuerySchedulerTransactionsRequest extends AbstractRequest
{

    private $environment;

    /**
     * QuerySchedulerTransactionsRequest constructor.
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
        $url = $this->environment->getApiUrl() . 'schedule-api/transactions?' . $schedulerQuery->getQueryParams();

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
