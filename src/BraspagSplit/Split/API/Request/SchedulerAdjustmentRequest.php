<?php

namespace BraspagSplit\Split\Api\Request;

use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Split\API\Environment;
use BraspagSplit\Split\API\SchedulerAdjustment;

/**
 * Class SchedulerAdjustmentRequest
 *
 * @package BraspagSplit\Split\Api\Request
 */
class SchedulerAdjustmentRequest extends AbstractRequest
{

    private $environment;

    /**
     * SchedulerAdjustmentRequest constructor.
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
     * @param $schedulerAdjustment
     *
     * @return null
     * @throws \BraspagSplit\API\Request\BraspagRequestException
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
