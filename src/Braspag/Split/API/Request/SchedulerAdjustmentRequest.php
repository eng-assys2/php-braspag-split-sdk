<?php

namespace Braspag\Split\Api\Request;

use Braspag\Merchant;

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
     * @throws \Braspag\API\Request\BraspagRequestException
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
