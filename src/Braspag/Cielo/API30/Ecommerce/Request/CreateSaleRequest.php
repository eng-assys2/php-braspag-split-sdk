<?php

namespace Braspag\Cielo\API30\Ecommerce\Request;

use Braspag\Cielo\API30\Ecommerce\Sale;
use Braspag\Environment;
use Braspag\Merchant;

use Braspag\Request\AbstractRequest;

/**
 * Class CreateSaleRequest
 *
 * @package Braspag\Cielo\API30\Ecommerce\Request
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
     * @throws \Braspag\Request\BraspagRequestException
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
