<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\Request;

use BraspagSplit\Cielo\API30\Ecommerce\Sale;
use BraspagSplit\Environment;
use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

/**
 * Class QuerySaleRequest
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\Request
 */
class QuerySaleRequest extends AbstractRequest
{

    private $environment;

    /**
     * QuerySaleRequest constructor.
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
     * @param $paymentId
     *
     * @return null
     * @throws \BraspagSplit\Request\BraspagRequestException
     * @throws \RuntimeException
     */
    public function execute($paymentId)
    {
        $url = $this->environment->getApiQueryURL() . '1/sales/' . $paymentId;

        return $this->sendRequest('GET', $url);
    }

    /**
     * @param $json
     *
     * @return Sale
     */
    protected function unserialize($json)
    {
        return Sale::fromJson($json);
    }
}
