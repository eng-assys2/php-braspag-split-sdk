<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysisShipping
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisShipping implements CieloSerializable
{

    private $addressee;
    private $method;
    private $phone;

    /**
     * FraudAnalysisShipping constructor.
     *
     */
    public function __construct($addressee, $method, $phone)
    {
        $this->addressee = $addressee;
        $this->method = $method;
        $this->phone = $phone;
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
        $this->addressee = isset($data->Addressee) ? $data->Addressee : null;
        $this->method = isset($data->Method) ? $data->method : null;
        $this->phone = isset($data->Phone) ? $data->Phone : null;
    }

    /**
     * @return mixed
     */
    public function getAddressee()
    {
        return $this->addressee;
    }

    /**
     * @param $addressee
     *
     * @return $this
     */
    public function setAddressee($addressee)
    {
        $this->addressee = $addressee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}
