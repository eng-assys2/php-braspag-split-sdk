<?php

namespace Braspag\Split\API;

/**
 * Class SchedulerQueryResponse
 *
 * @package Braspag\Split\API
 */
class SchedulerQueryResponse implements \JsonSerializable
{
    /** @var string|null 
     * Merchant ID da Braspag
     */
    private $pageCount;

    /** @var string|null 
     * Merchant Key da Braspag
     * Default: bearer
     */
    private $pageSize;

    /** @var string|null 
     * Token de Acesso Gerado pela Braspag
     */
    private $pageIndex;

    /** @var string|null 
     * Tipo de Token.
     * Default: bearer
     */
    private $transactions;

    /** @var integer|null 
     * Momento de expiração do Token
     * Default: T + 20 min
     */
    private $schedules;

    /**
     * @param $json
     *
     * @return SchedulerQueryResponse
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new SchedulerQueryResponse();
        $auth->populate($object);

        return $auth;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->pageCount = isset($data->PageCount) ? $data->PageCount : 0;
        $this->pageSize = isset($data->PageSize) ? $data->PageSize : 0;
        $this->pageIndex = isset($data->PageIndex) ? $data->PageIndex : 0;

        $this->transactions = [];
        if (isset($data->Transactions)) {
            foreach ($data->Transactions as $transactions) {
                $schedulerTransaction = new SchedulerTransaction();
                $schedulerTransaction->populate($transactions);    
                $this->transactions[] = $schedulerTransaction;
            }
        }

        $this->schedules = [];
        if (isset($data->Schedules)) {
            foreach ($data->Schedules as $schedules) {
                $schedulerEvent = new SchedulerEvent();
                $schedulerEvent->populate($schedules);    
                $this->schedules[] = $schedulerEvent;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @param $pageCount
     *
     * @return $this
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageIndex()
    {
        return $this->pageIndex;
    }

    /**
     * @param $pageIndex
     *
     * @return $this
     */
    public function setPageIndex($pageIndex)
    {
        $this->pageIndex = $pageIndex;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * @param $schedules
     *
     * @return $this
     */
    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param $transactions
     *
     * @return $this
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;

        return $this;
    }

}
