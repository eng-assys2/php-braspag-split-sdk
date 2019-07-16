<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\Request;

use BraspagSplit\Cielo\API30\Ecommerce\CreditCard;
use BraspagSplit\Cielo\API30\Ecommerce\Environment;
use BraspagSplit\Merchant;

use BraspagSplit\Request\AbstractRequest;

/**
 * Class CreateCardTokenRequestHandler
 *
 * @package AppBundle\Handler\Cielo
 */
class TokenizeCardRequest extends AbstractRequest
{

    private $environment;
    /** @var Merchant $merchant */
    private $merchant;

    /**
     * CreateCardTokenRequestHandler constructor.
     *
     * @param Merchant    $merchant
     * @param Environment $environment
     */
    public function __construct(Merchant $merchant, Environment $environment)
    {
        parent::__construct($merchant);

        $this->merchant    = $merchant;
        $this->environment = $environment;
    }

    /**
     * @inheritdoc
     */
    public function execute($param)
    {
        $url = $this->environment->getApiUrl() . '1/card/';

        return $this->sendRequest('POST', $url, $param);
    }

    /**
     * @inheritdoc
     */
    protected function unserialize($json)
    {
        return CreditCard::fromJson($json);
    }
}
