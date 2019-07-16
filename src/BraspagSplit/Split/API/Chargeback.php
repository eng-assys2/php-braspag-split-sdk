<?php

namespace BraspagSplit\Split\API;

/**
 * Class Chargeback
 *
 * @package BraspagSplit\Split\API
 */
class Chargeback implements \JsonSerializable
{
    /** @var guid 
     * Identificador do Subordinado.
     */
    private $subordinateMerchantId;

    /** @var integer
     * Valor do chargeback que deverá ser repassado ao Subordinado, em centavos.
     */
    private $chargebackAmount;

    /** @var ChargebackSplit
     * Lista contendo a divisão do chargeback para cada participante.
     */
    private $chargebackSplits;

    /**
     * @param $json
     *
     * @return Chargeback
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $chargeback = new Chargeback();
        $chargeback->populate($object);

        return $chargeback;
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
        $this->subordinateMerchantId = isset($data->SubordinateMerchantId) ? $data->SubordinateMerchantId : null;
        $this->chargebackAmount = isset($data->ChargebackAmount) ? $data->ChargebackAmount : 0;

        $this->chargebackSplits = [];
        if (isset($data->ChargebackSplits)) {
            foreach ($data->ChargebackSplits as $chargebackSplits) {
                $chargebackSplit = new ChargebackSplit();
                $chargebackSplit->populate($chargebackSplits);    
                $this->chargebackSplits[] = $chargebackSplit;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getSubordinateMerchantId()
    {
        return $this->subordinateMerchantId;
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
     * @return mixed
     */
    public function getChargebackAmount()
    {
        return $this->chargebackAmount;
    }

    /**
     * @param $chargebackAmount
     *
     * @return $this
     */
    public function setChargebackAmount($chargebackAmount)
    {
        $this->chargebackAmount = $chargebackAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChargebackSplits()
    {
        return $this->chargebackSplits;
    }

    /**
     * @param $chargebackSplits
     *
     * @return $this
     */
    public function setChargebackSplits($chargebackSplits)
    {
        $this->chargebackSplits = $chargebackSplits;

        return $this;
    }

}
