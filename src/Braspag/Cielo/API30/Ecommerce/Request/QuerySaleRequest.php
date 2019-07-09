<?php

namespace Braspag\Cielo\API30\Ecommerce\Request;

use Braspag\Cielo\API30\Ecommerce\Sale;
use Braspag\Environment;
use Braspag\Merchant;

/**
 * Class QuerySaleRequest
 *
 * @package Braspag\Cielo\API30\Ecommerce\Request
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
     * @throws \Braspag\Cielo\API30\Ecommerce\Request\CieloRequestException
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
