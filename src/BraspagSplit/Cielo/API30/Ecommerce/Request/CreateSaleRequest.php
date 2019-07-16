<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\Request;

use BraspagSplit\Cielo\API30\Ecommerce\Sale;
use BraspagSplit\Environment;
use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

/**
 * Class CreateSaleRequest
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\Request
 */
class CreateSaleRequest extends AbstractRequest
{

    private $environment;

    /**
     * CreateSaleRequest constructor.
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
     * @param $sale
     *
     * @return null
     * @throws \BraspagSplit\Request\BraspagRequestException
     * @throws \RuntimeException
     */
    public function execute($sale)
    {
        $url = $this->environment->getApiUrl() . '1/sales/';

        return $this->sendRequest('POST', $url, $sale);
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
