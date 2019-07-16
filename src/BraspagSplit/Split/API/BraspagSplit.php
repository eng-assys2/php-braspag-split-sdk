<?php

namespace BraspagSplit\Split\Api;

use BraspagSplit\Split\API\Request\QuerySchedulerEventsRequest;
use BraspagSplit\Split\API\Request\QuerySchedulerTransactionsRequest;
use BraspagSplit\Split\API\Request\SchedulerAdjustmentRequest;
use BraspagSplit\Split\API\Request\HandleChargebackRequest;

use BraspagSplit\Merchant;

/**
 * The Braspag Split SDK front-end;
 */
class BraspagSplit
{

    private $merchant;

    private $environment;

    /**
     * Create an instance of BraspagSplit choosing the environment where the
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
     * Send a Query to Split Sheduler to Get Event related data.
     *
     * @param SchedulerQuery $schedulerQuery
     *            The preconfigured Scheduler Query
     *
     * @return SchedulerQueryResponse The response of a query in Scheduler
     *
     * @throws \BraspagSplit\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function querySchedulerEvents(SchedulerQuery $schedulerQuery)
    {
        $querySchedulerEventsRequest = new QuerySchedulerEventsRequest($this->merchant, $this->environment);

        return $querySchedulerEventsRequest->execute($schedulerQuery);
    }

    /**
     * Send a Query to Split Sheduler to Get Transaction related data.
     *
     * @param SchedulerQuery $schedulerQuery
     *            The preconfigured Scheduler Query
     *
     * @return SchedulerQueryResponse The response of a query in Scheduler
     *
     * @throws \BraspagSplit\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function querySchedulerTransactions(SchedulerQuery $schedulerQuery)
    {
        $querySchedulerTransactionsRequest = new QuerySchedulerTransactionsRequest($this->merchant, $this->environment);

        return $querySchedulerTransactionsRequest->execute($schedulerQuery);
    }

    /**
     * Schedules adjustments in Split Scheduler specifying the amount
     *
     * @param string  $paymentId
     *            The paymentId to be queried
     * @param integer $amount
     *            Order value in cents
     *
     * @return SchedulerAdjustment The Adjustment in Scheduler
     *
     * @throws \BraspagSplit\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function schedulerAdjustment($paymentId)
    {
        $updateSaleRequest = new SchedulerAdjustmentRequest($this->merchant, $this->environment);

        return $updateSaleRequest->execute($paymentId);
    }

    /**
     * Handles With Chargebacks
     *
     * @param string  $chargebackId
     *            The chargebackId to be handled
     * @param integer $chargeback
     *            The information to hadle the chargeback
     *
     * @return Chargeback 
     *
     * @throws \BraspagSplit\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function handleChargeback($chargebackId, $chargeback)
    {
        $handleChargebackRequest = new HandleChargebackRequest($this->merchant, $this->environment);

        $handleChargebackRequest->setChargebackId($chargebackId);

        return $handleChargebackRequest->execute($chargeback);
    }

}
