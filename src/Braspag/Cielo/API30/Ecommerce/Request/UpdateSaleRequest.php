<?php

namespace Braspag\Cielo\API30\Ecommerce\Request;

use Braspag\Cielo\API30\Ecommerce\Payment;
use Braspag\Environment;
use Braspag\Merchant;

/**
 * Class UpdateSaleRequest
 *
 * @package Braspag\Cielo\API30\Ecommerce\Request
 */
class UpdateSaleRequest extends AbstractRequest
{

    private $environment;

    private $type;

    private $serviceTaxAmount;

    private $amount;

    /**
     * UpdateSaleRequest constructor.
     *
     * @param Merchant    $type
     * @param Merchant    $merchant
     * @param Environment $environment
     */
    public function __construct($type, Merchant $merchant, Environment $environment)
    {
        parent::__construct($merchant);

        $this->environment = $environment;
        $this->type        = $type;
    }

    /**
     * @param $paymentId
     *
     * @return null
     * @throws \Braspag\Cielo\API30\Ecommerce\Request\CieloRequestException
     * @throws \RuntimeException
     */
    public function execute($paymentId)
    {
        $url    = $this->environment->getApiUrl() . '1/sales/' . $paymentId . '/' . $this->type;
        $params = [];

        if ($this->amount != null) {
            $params['amount'] = $this->amount;
        }

        if ($this->serviceTaxAmount != null) {
            $params['serviceTaxAmount'] = $this->serviceTaxAmount;
        }

        $url .= '?' . http_build_query($params);

        return $this->sendRequest('PUT', $url);
    }

    /**
     * @param $json
     *
     * @return Payment
     */
    protected function unserialize($json)
    {
        return Payment::fromJson($json);
    }

    /**
     * @return mixed
     */
    public function getServiceTaxAmount()
    {
        return $this->serviceTaxAmount;
    }

    /**
     * @param $serviceTaxAmount
     *
     * @return $this
     */
    public function setServiceTaxAmount($serviceTaxAmount)
    {
        $this->serviceTaxAmount = $serviceTaxAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
