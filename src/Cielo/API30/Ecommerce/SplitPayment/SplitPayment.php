<?php

namespace Cielo\API30\Ecommerce\SplitPayment;

use Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class SplitPayment
 *
 * @package Cielo\API30\Ecommerce
 */
class SplitPayment implements CieloSerializable
{

    private $subordinateMerchantId;
    private $amount;
    private $fares;

    /**
     * SplitPayment constructor.
     *
     */
    public function __construct($subordinateMerchantId=null, $amount = 0, $fares=null)
    {
        $this->subordinateMerchantId = $subordinateMerchantId;
        $this->amount = $amount;
        $this->fares = $fares;
    }

    /**
     * @param $json
     *
     * @return SplitPayment
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $splitPayments = new SplitPayment();

        if (isset($object->SplitPayment)) {
            $splitPayments->populate($object->SplitPayment);
        }

        return $splitPayments;
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->subordinateMerchantId = isset($data->SubordinateMerchantId) ? !!$data->SubordinateMerchantId : false;
        $this->amount = isset($data->Amount) ? $data->Amount : null;

        if (isset($data->Fares)) {
            $this->fares = new SplitPaymentFares();
            $this->fares->populate($data->Fares);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getSubordinateMerchantId()
    {
        return $this->subordinateMerchantId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getFares()
    {
        return $this->fares;
    }

    /**
     * @param $subordinateMerchantId
     *
     * @return $this
     */
    public function setSubordinateMerchantId($subordinateMerchantId)
    {
        $this->subordinateMerchantId = $subordinateMerchantId;

        return $this;
    }

    /**
     * @param $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param $fares
     *
     * @return $this
     */
    public function setFares($fares)
    {
        $this->fares = $fares;

        return $this;
    }

    /**
     * @param $mbr
     * @param $fee
     * 
     * @return SplitPaymentFares
     */
    public function fares($mbr, $fee)
    {
        $fares = new SplitPaymentFares($mbr, $fee);

        $this->setFares($fares);

        return $fares;
    }

}
