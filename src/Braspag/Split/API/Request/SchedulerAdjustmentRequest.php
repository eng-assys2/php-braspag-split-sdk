<?php

namespace Braspag\Split\Api\Request;

use Braspag\Request\AbstractRequest;

use Braspag\Split\API\Environment;
use Braspag\Split\API\SchedulerAdjustment;

/**
 * Class SchedulerAdjustmentRequest
 *
 * @package Braspag\Split\Api\Request
 */
class SchedulerAdjustmentRequest extends AbstractRequest
{

    private $environment;

    /**
     * SchedulerAdjustmentRequest constructor.
     *
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param $paymentId
     *
     * @return Braspag\Auth\API\SchedulerAdjustment
     * @throws \GuzzleHttp\Exception\ConnectException
     */
    public function execute($schedulerAdjustment)
    {
        $url = $this->environment->getApiUrl() . 'adjustment-api/adjustments';

        return $this->sendRequest('POST', $url, $schedulerAdjustment);
    }

    /**
     * @param $json
     *
     * @return SchedulerAdjustment
     */
    protected function unserialize($json)
    {
        return SchedulerAdjustment::fromJson($json);
    }

}
