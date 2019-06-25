<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysisTravel
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisTravel implements CieloSerializable
{
    /** @var string Tipo de viagem. */
    private $journeyType;
    /** @var datetime|null Data, hora e minuto de partida do vôo. Ex: “2018-01-09 18:00:00” */
    private $departureTime;
    /** @var FraudAnalysisPassenger */
    private $passengers;

    /**
     * FraudAnalysisTravel constructor.
     *
     */
    public function __construct($journeyType, $passengers, $departureTime=null)
    {
        $this->journeyType = $journeyType;
        $this->departureTime = $departureTime;
        $this->passengers = $passengers;
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
        $this->journeyType = isset($data->JourneyType) ? $data->JourneyType : null;
        $this->departureTime = isset($data->DepartureTime) ? $data->DepartureTime : null;
        $this->passengers = isset($data->Passengers) ? $data->Passengers : null;
    }

    /**
     * @return mixed
     */
    public function getJourneyType()
    {
        return $this->journeyType;
    }

    /**
     * @param $journeyType
     *
     * @return $this
     */
    public function setJourneyType($journeyType)
    {
        $this->journeyType = $journeyType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param $departureTime
     *
     * @return $this
     */
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * @param $passengers
     *
     * @return $this
     */
    public function setPassengers($passengers)
    {
        $this->passengers = $passengers;

        return $this;
    }
}
