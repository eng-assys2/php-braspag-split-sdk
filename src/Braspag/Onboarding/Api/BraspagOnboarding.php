<?php

namespace Braspag\Onboarding\Api;

use Braspag\Onboarding\API\Request\CreateSubordinateMerchantRequest;
use Braspag\Onboarding\API\Request\QuerySubordinateMerchantRequest;

use Braspag\Merchant;

/**
 * The Braspag Onboarding SDK front-end;
 */
class BraspagOnboarding
{

    private $merchant;

    private $environment;

    /**
     * Create an instance of BraspagOnboarding choosing the environment where the
     * requests will be send
     *
     * @param Merchant $merchant
     *            The merchant credentials
     * @param Environment environment
     *            The environment: {@link Environment::production()} or
     *            {@link Environment::sandbox()}
     */
    public function __construct(Merchant $merchant, Environment $environment = null)
    {
        if ($environment == null) {
            $environment = Environment::sandbox();
        }

        $this->merchant    = $merchant;
        $this->environment = $environment;
    }

    /**
     * Send a Query to Get a Subordinate Merchant using the subordinateMerchantId
     *
     * @param $subordinateMerchantId
     *            The Id of SubordinateMerchant
     *
     * @return SubordinateMerchant 
     *
     * @throws \Braspag\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function querySubordinateMerchantRequest($subordinateMerchantId)
    {
        $querySubordinateMerchantRequest = new QuerySubordinateMerchantRequest($this->merchant, $this->environment);

        return $querySubordinateMerchantRequest->execute($subordinateMerchantId);
    }

    /**
     * Schedules adjustments in Split Scheduler specifying the amount
     *
     * @param SubordinateMerchant $subordinateMerchant
     *            The Subordinate Merchant info
     *
     * @return SubordinateMerchant
     *
     * @throws \Braspag\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function createSubordinateMerchant($subordinateMerchant)
    {
        $createSubordinateMerchantRequest = new CreateSubordinateMerchantRequest($this->merchant, $this->environment);

        return $createSubordinateMerchantRequest->execute($subordinateMerchant);
    }

}
