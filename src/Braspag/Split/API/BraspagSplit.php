<?php

namespace Braspag\Split\Api;

use Braspag\Split\API\Request\QuerySchedulerEventsRequest;
use Braspag\Split\API\Request\QuerySchedulerTransactionsRequest;
use Braspag\Split\API\Request\SchedulerAdjustmentRequest;

use Braspag\Merchant;

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
     * @throws \Braspag\API\Request\BraspagRequestException if anything gets wrong.
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
     * @throws \Braspag\API\Request\BraspagRequestException if anything gets wrong.
     *
     */
    public function querySchedulerTransactions(SchedulerQuery $schedulerQuery)
    {
        $querySchedulerTransactionsRequest = new QuerySchedulerTransactionsRequest($this->merchant, $this->environment);

        return $querySchedulerTransactionsRequest->execute($schedulerQuery);
    }

    // /**
    //  * Cancel a Sale on Cielo by paymentId and speficying the amount
    //  *
    //  * @param string  $paymentId
    //  *            The paymentId to be queried
    //  * @param integer $amount
    //  *            Order value in cents
    //  *
    //  * @return Sale The Sale with authorization, tid, etc. returned by Cielo.
    //  *
    //  * @throws \Braspag\API\Request\BraspagRequestException if anything gets wrong.
    //  *
    //  */
    // public function schedulerAdjustment($paymentId, $amount = null)
    // {
    //     $updateSaleRequest = new SchedulerAdjustmentRequest('void', $this->merchant, $this->environment);

    //     $updateSaleRequest->setAmount($amount);

    //     return $updateSaleRequest->execute($paymentId);
    // }

}
