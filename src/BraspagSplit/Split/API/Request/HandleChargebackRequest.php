<?php

namespace BraspagSplit\Split\Api\Request;

use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Split\API\Environment;
use BraspagSplit\Split\API\Chargeback;

/**
 * Class HandleChargebackRequest
 *
 * @package BraspagSplit\Split\Api\Request
 */
class HandleChargebackRequest extends AbstractRequest
{

    private $environment;

    private $chargebackId;

    /**
     * HandleChargebackRequest constructor.
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
     * @param $chargeback
     *
     * @return null
     * @throws \BraspagSplit\API\Request\BraspagRequestException
     */
    public function execute($chargeback)
    {
        $url = $this->environment->getApiUrl() . "api/chargebacks/{$this->chargebackId}/splits";

        return $this->sendRequest('POST', $url, $chargeback);
    }

    /**
     * @param $json
     *
     * @return Chargeback
     */
    protected function unserialize($json)
    {
        return Chargeback::fromJson($json);
    }

    /**
     * @return mixed
     */
    public function getChargebackId()
    {
        return $this->chargebackId;
    }

    /**
     * @param $chargebackId
     *
     * @return $this
     */
    public function setChargebackId($chargebackId)
    {
        $this->chargebackId = $chargebackId;

        return $this;
    }

}
