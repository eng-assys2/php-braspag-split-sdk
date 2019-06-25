<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysisPassenger
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisPassenger implements CieloSerializable
{ 

    private $email;
    private $identity;
    private $name;
    private $rating;
    private $phone;
    private $status;
    private $travelLegs;
    

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
        $this->email = isset($data->Email) ? $data->Email: null;
        $this->identity = isset($data->Identity) ? $data->Identity: null;
        $this->name = isset($data->Name) ? $data->Name: null;
        $this->rating = isset($data->Rating) ? $data->Rating: null;
        $this->phone = isset($data->Phone) ? $data->Phone: null;
        $this->status = isset($data->Status) ? $data->Status: null;
        $this->travelLegs = isset($data->TravelLegs) ? $data->TravelLegs: null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param $identity
     *
     * @return $this
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

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

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTravelLegs()
    {
        return $this->travelLegs;
    }

    /**
     * @param $travelLegs
     *
     * @return $this
     */
    public function setTravelLegs($travelLegs)
    {
        $this->travelLegs = $travelLegs;

        return $this;
    }
}
