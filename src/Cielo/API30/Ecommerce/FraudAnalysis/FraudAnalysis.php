<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysis
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysis implements CieloSerializable
{

    private $provider;
    private $sequence;
    private $sequenceCriteria;
    private $captureOnLowRisk;
    private $voidOnHighRisk;
    private $totalOrderAmount;
    private $fingerPrintId;
    private $browser;
    private $cart;
    private $merchantDefinedFields;
    private $shipping;
    private $travel;
    

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
        $this->provider = isset($data->Provider) ? $data->Provider : null;
        $this->sequence = isset($data->Sequence) ? $data->Sequence : null;
        $this->sequenceCriteria = isset($data->SequenceCriteria) ? $data->SequenceCriteria : null;
        $this->captureOnLowRisk = isset($data->CaptureOnLowRisk) ? $data->CaptureOnLowRisk : null;
        $this->voidOnHighRisk = isset($data->VoidOnHighRisk) ? $data->VoidOnHighRisk : null;
        $this->totalOrderAmount = isset($data->TotalOrderAmount) ? $data->TotalOrderAmount : null;
        $this->fingerPrintId = isset($data->FingerPrintId) ? $data->FingerPrintId : null;
        $this->browser = isset($data->Browser) ? $data->Browser : null;
        $this->cart = isset($data->Cart) ? $data->Cart : null;
        $this->merchantDefinedFields = isset($data->MerchantDefinedFields) ? $data->MerchantDefinedFields : null;
        $this->shipping = isset($data->Shipping) ? $data->Shipping : null;
        $this->travel = isset($data->Travel) ? $data->Travel : null;
    }
    
    /**
     * @return mixed
     */
    public function getProvider(){
        return $this->provider;
    }

    /**
     * @param $provider
     *
     * @return $this
     */
    public function setProvider($provider){
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSequence(){
        return $this->sequence;
    }

    /**
     * @param $sequence
     *
     * @return $this
     */
    public function setSequence($sequence){
        $this->sequence = $sequence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSequenceCriteria(){
        return $this->sequenceCriteria;
    }

    /**
     * @param $sequenceCriteria
     *
     * @return $this
     */
    public function setSequenceCriteria($sequenceCriteria){
        $this->sequenceCriteria = $sequenceCriteria;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaptureOnLowRisk(){
        return $this->captureOnLowRisk;
    }

    /**
     * @param $captureOnLowRisk
     *
     * @return $this
     */
    public function setCaptureOnLowRisk($captureOnLowRisk){
        $this->captureOnLowRisk = $captureOnLowRisk;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoidOnHighRisk(){
        return $this->voidOnHighRisk;
    }

    /**
     * @param $voidOnHighRisk
     *
     * @return $this
     */
    public function setVoidOnHighRisk($voidOnHighRisk){
        $this->voidOnHighRisk = $voidOnHighRisk;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalOrderAmount(){
        return $this->totalOrderAmount;
    }

    /**
     * @param $totalOrderAmount
     *
     * @return $this
     */
    public function setTotalOrderAmount($totalOrderAmount){
        $this->totalOrderAmount = $totalOrderAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFingerPrintId(){
        return $this->fingerPrintId;
    }

    /**
     * @param $fingerPrintId
     *
     * @return $this
     */
    public function setFingerPrintId($fingerPrintId){
        $this->fingerPrintId = $fingerPrintId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrowser(){
        return $this->browser;
    }

    /**
     * @param $browser
     *
     * @return $this
     */
    public function setBrowser($browser){
        $this->browser = $browser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getcart(){
        return $this->cart;
    }

    /**
     * @param $cart
     *
     * @return $this
     */
    public function setCart($cart){
        $this->cart = $cart;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMerchantDefinedFields(){
        return $this->merchantDefinedFields;
    }

    /**
     * @param $merchantDefinedFields
     *
     * @return $this
     */
    public function setMerchantDefinedFields($merchantDefinedFields){
        $this->merchantDefinedFields = $merchantDefinedFields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipping(){
        return $this->shipping;
    }

    /**
     * @param $shipping
     *
     * @return $this
     */
    public function setShipping($shipping){
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTravel(){

    }

    /**
     * @param $travel
     *
     * @return $this
     */
    public function setTravel($travel){
        $this->travel = $travel;
        return $this;
    }
}