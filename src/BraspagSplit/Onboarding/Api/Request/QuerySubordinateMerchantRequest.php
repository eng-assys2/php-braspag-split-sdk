<?php

namespace BraspagSplit\Onboarding\Api\Request;

use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Onboarding\API\Environment;
use BraspagSplit\Onboarding\API\SubordinateMerchant;

/**
 * Class QuerySubordinateMerchantRequest
 *
 * @package BraspagSplit\Onboarding\Api\Request
 */
class QuerySubordinateMerchantRequest extends AbstractRequest
{

    private $environment;

    /**
     * QuerySubordinateMerchantRequest constructor.
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
     * @param $subordinateMerchantId
     *
     * @return null
     * @throws \BraspagSplit\API\Request\BraspagRequestException
     */
    public function execute($subordinateMerchantId)
    {
        $url = $this->environment->getApiUrl() . 'api/subordinates/' . $subordinateMerchantId;

        return $this->sendRequest('GET', $url);
    }

    /**
     * @param $json
     *
     * @return SubordinateMerchant
     */
    protected function unserialize($json)
    {
        return SubordinateMerchant::fromJson($json);
    }

}
