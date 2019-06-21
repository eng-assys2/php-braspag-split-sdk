<?php

namespace Cielo\API30\Ecommerce;

/**
 * Class SplitPayment
 *
 * @package Cielo\API30\Ecommerce
 */
class SplitPayment implements \JsonSerializable
{

    private $subordinateMerchantId;
    private $amount;
    private $fares;

    /**
     * SplitPayment constructor.
     *
     */
    public function __construct($subordinateMerchantId)
    {
        $this->subordinateMerchantId = $subordinateMerchantId;
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

        if (isset($data->fares)) {
            $this->fares = new SplitPaymentFares();
            $this->fares->populate($data->SplitPaymentFares);
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

}
