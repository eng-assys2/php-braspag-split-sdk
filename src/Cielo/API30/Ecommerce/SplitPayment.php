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
    private $faresMdr;
    private $faresFee;

    /**
     * SplitPayment constructor.
     *
     */
    public function __construct()
    {
        
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
        $this->faresMdr = isset($data->FaresMdr) ? $data->FaresMdr : null;
        $this->faresFee = isset($data->FaresFee) ? $data->FaresFee : null;
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
    public function getFaresMdr()
    {
        return $this->faresMdr;
    }

    /**
     * @return mixed
     */
    public function getFaresFee()
    {
        return $this->faresFee;
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
     * @param $faresMdr
     *
     * @return $this
     */
    public function setFaresMdr($faresMdr)
    {
        $this->faresMdr = $faresMdr;

        return $this;
    }

    /**
     * @param $faresFee
     *
     * @return $this
     */
    public function setFaresFee($faresFee)
    {
        $this->faresFee = $faresFee;

        return $this;
    }

}
