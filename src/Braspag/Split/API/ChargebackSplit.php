<?php

namespace Braspag\Split\API;

/**
 * Class Chargeback
 *
 * @package Braspag\Split\API
 */
class Chargeback implements \JsonSerializable
{
    /** @var guid 
     * Identificador do Subordinado.
     */
    private $merchantId;

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
        $this->merchantId = isset($data->MerchantId) ? $data->MerchantId : null;
        $this->chargebackAmount = isset($data->ChargebackAmount) ? $data->ChargebackAmount : 0;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param $merchantId
     *
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

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

}
