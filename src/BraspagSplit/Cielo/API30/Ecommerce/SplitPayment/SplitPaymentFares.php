<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\SplitPayment;

use BraspagSplit\Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class SplitPaymentFares
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\SplitPayment
 */
class SplitPaymentFares implements CieloSerializable
{
    /** @var double|null 
     * MDR(%) do Marketplace a ser descontado do valor referente a participação do Subordinado
     */
    private $mdr;

    /** @var integer|null 
     * Tarifa (R$) a ser descontada do valor referente a participação do Subordinado, em centavos.
     */
    private $fee;

    /**
     * SplitPaymentFares constructor.
     *
     */
    public function __construct($mdr = 0, $fee = 0)
    {
        $this->mdr = $mdr;
        $this->fee = $fee;
    }

    /**
     * @param $json
     *
     * @return SplitPaymentFares
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $fares = new SplitPaymentFares();

        if (isset($object->Fares)) {
            $fares->populate($object->Fares);
        }

        return $fares;
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->mdr = isset($data->Mdr) ? $data->Mdr : 0;
        $this->fee = isset($data->Fee) ? $data->Fee : 0;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @return mixed
     */
    public function getMdr()
    {
        return $this->mdr;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }


    /**
     * @param $mdr
     *
     * @return $this
     */
    public function setMdr($mdr)
    {
        $this->mdr = $mdr;

        return $this;
    }

    /**
     * @param $fee
     *
     * @return $this
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

}
