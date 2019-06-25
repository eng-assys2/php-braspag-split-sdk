<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysisTravelLegs
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisTravelLegs implements CieloSerializable
{

    private $origin;
    private $destination;

    /**
     * FraudAnalysisTravelLegs constructor.
     *
     */
    public function __construct($origin, $destination)
    {
        $this->origin = $origin;
        $this->destination = $destination;
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
        $this->origin = isset($data->Origin) ? $data->Origin : null;
        $this->destination = isset($data->Destination) ? $data->Destination : null;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param $origin
     *
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param $destination
     *
     * @return $this
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }
}
