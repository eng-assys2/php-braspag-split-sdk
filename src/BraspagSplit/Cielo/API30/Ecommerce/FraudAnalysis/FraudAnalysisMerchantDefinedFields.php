<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis;

use BraspagSplit\Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class FraudAnalysisMerchantDefinedFields
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisMerchantDefinedFields implements CieloSerializable
{
    /** @var string Id das informações adicionais a serem enviadas. */
    private $id;
    /** @var string Valor das informações adicionais a serem enviadas. */
    private $value;

    /**
     * FraudAnalysisMerchantDefinedFields constructor.
     *
     */
    public function __construct($id=null, $value=null)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->id = isset($data->Id) ? $data->Id : null;
        $this->value = isset($data->Value) ? $data->Value : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

}
