<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class Address implements \JsonSerializable
{
    private $street;

    private $number;

    private $complement;

    private $neighborhood;

    private $city;

    private $state;	

    private $zipCode;

    /**
     * @param $json
     *
     * @return Address
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new Address();
        $auth->populate($object);

        return $auth;
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
        $this->street = isset($data->Street) ? $data->Street : null;
        $this->number = isset($data->Number) ? $data->Number : null;
        $this->complement = isset($data->Complement) ? $data->Complement : null;
        $this->neighborhood = isset($data->Neighborhood) ? $data->Neighborhood : null;
        $this->city = isset($data->City) ? $data->City : null;
        $this->state = isset($data->State) ? $data->State : null;	
        $this->zipCode = isset($data->ZipCode) ? $data->ZipCode : null;

    }

    /**
     * @return mixed
     */
    public function getStreet(){
        return $this->street;
    }

    /**
     * @param $street
     *
     * @return $this
     */
    public function setStreet($street){
        $this->street = $street;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber(){
        return $this->number;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function setNumber($number){
        $this->number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplement(){
        return $this->complement;
    }

    /**
     * @param $complement
     *
     * @return $this
     */
    public function setComplement($complement){
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNeighborhood(){
        return $this->neighborhood;
    }

    /**
     * @param $neighborhood
     *
     * @return $this
     */
    public function setNeighborhood($neighborhood){
        $this->neighborhood = $neighborhood;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city){
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState(){
        return $this->state;
    }

    /**
     * @param $state
     *
     * @return $this
     */
    public function setState($state){
        $this->state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipCode(){
        return $this->zipCode;
    }

    /**
     * @param $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode){
        $this->zipCode = $zipCode;
        return $this;
    }


}
