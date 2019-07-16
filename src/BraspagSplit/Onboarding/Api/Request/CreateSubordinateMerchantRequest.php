<?php

namespace BraspagSplit\Onboarding\Api\Request;

use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Onboarding\API\Environment;
use BraspagSplit\Onboarding\API\SubordinateMerchant;

/**
 * Class CreateSubordinateMerchantRequest
 *
 * @package BraspagSplit\Onboarding\Api\Request
 */
class CreateSubordinateMerchantRequest extends AbstractRequest
{

    private $environment;

    /**
     * CreateSubordinateMerchantRequest constructor.
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
     * @param $subordinateMerchant
     *
     * @return null
     * @throws \BraspagSplit\API\Request\BraspagRequestException
     */
    public function execute($subordinateMerchant)
    {
        $url = $this->environment->getApiUrl() . 'api/subordinates';

        return $this->sendRequest('POST', $url, $subordinateMerchant);
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
