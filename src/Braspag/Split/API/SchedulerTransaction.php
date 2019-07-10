<?php

namespace Braspag\Split\API;

/**
 * Class SchedulerTransaction
 *
 * @package Braspag\Split\API
 */
class SchedulerTransaction implements \JsonSerializable
{
    
    private $paymentId;

    private $captureDate;

    private $schedules;

    /**
     * @param $json
     *
     * @return SchedulerTransaction
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $schedulerTransaction = new SchedulerTransaction();
        $schedulerTransaction->populate($object);

        return $schedulerTransaction;
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
        $this->paymentId = isset($data->paymentId) ? $data->paymentId : null;
        $this->captureDate = isset($data->captureDate) ? $data->captureDate : null;

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
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param $paymentId
     *
     * @return $this
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaptureDate()
    {
        return $this->captureDate;
    }

    /**
     * @param $captureDate
     *
     * @return $this
     */
    public function setCaptureDate($captureDate)
    {
        $this->captureDate = $captureDate;

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
     *
     * @return SchedulerEvent
     */
    public function schedule()
    {
        $schedulerEvent = new SchedulerEvent();
        $this->schedules[] = $schedulerEvent;

        return $schedulerEvent;
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

}
