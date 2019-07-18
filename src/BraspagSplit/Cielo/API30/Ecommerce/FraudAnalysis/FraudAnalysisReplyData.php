<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis;

use BraspagSplit\Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class FraudAnalysisReplyData
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisReplyData implements CieloSerializable
{
    private $addressInfoCode;
    
    private $factorCode;
    
    private $score;
    
    private $hostSeverity;
    
    private $hotListInfoCode;
    
    private $ipCity;
    
    private $ipCountry;
    
    private $ipRoutingMethod;
    
    private $ipState;
    
    private $scoreModelUsed;
    
    private $velocityInfoCode;
    
    private $casePriority;
    
    private $providerTransactionId;
    

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
        $this->addressInfoCode = isset($data->AddressInfoCode) ? $data->AddressInfoCode : null;
        $this->factorCode = isset($data->FactorCode) ? $data->FactorCode : null;
        $this->score = isset($data->Score) ? $data->Score : null;
        $this->hostSeverity = isset($data->HostSeverity) ? $data->HostSeverity : null;
        $this->hotListInfoCode = isset($data->HotListInfoCode) ? $data->HotListInfoCode : null;
        $this->ipCity = isset($data->IpCity) ? $data->IpCity : null;
        $this->ipCountry = isset($data->IpCountry) ? $data->IpCountry : null;
        $this->ipRoutingMethod = isset($data->IpRoutingMethod) ? $data->IpRoutingMethod : null;
        $this->ipState = isset($data->IpState) ? $data->IpState : null;
        $this->scoreModelUsed = isset($data->ScoreModelUsed) ? $data->ScoreModelUsed : null;
        $this->velocityInfoCode = isset($data->VelocityInfoCode) ? $data->VelocityInfoCode : null;
        $this->casePriority = isset($data->CasePriority) ? $data->CasePriority : null;
        $this->providerTransactionId = isset($data->ProviderTransactionId) ? $data->ProviderTransactionId : null;
    }

    /**
     * @return mixed
     */
    public function getAddressInfoCode(){
        return $this->addressInfoCode;
    }

    /**
     * @param $addressInfoCode
     * 
     * @return @this
     */
    public function setAddressInfoCode($addressInfoCode){
        $this->addressInfoCode = $addressInfoCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFactorCode(){
        return $this->factorCode;
    }

    /**
     * @param $factorCode
     * 
     * @return @this
     */
    public function setFactorCode($factorCode){
        $this->factorCode = $factorCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore(){
        return $this->score;
    }

    /**
     * @param $score
     * 
     * @return @this
     */
    public function setScore($score){
        $this->score = $score;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHostSeverity(){
        return $this->hostSeverity;
    }

    /**
     * @param $hostSeverity
     * 
     * @return @this
     */
    public function setHostSeverity($hostSeverity){
        $this->hostSeverity = $hostSeverity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHotListInfoCode(){
        return $this->hotListInfoCode;
    }

    /**
     * @param $hotListInfoCode
     * 
     * @return @this
     */
    public function setHotListInfoCode($hotListInfoCode){
        $this->hotListInfoCode = $hotListInfoCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpCity(){
        return $this->ipCity;
    }

    /**
     * @param $ipCity
     * 
     * @return @this
     */
    public function setIpCity($ipCity){
        $this->ipCity = $ipCity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpCountry(){
        return $this->ipCountry;
    }

    /**
     * @param $ipCountry
     * 
     * @return @this
     */
    public function setIpCountry($ipCountry){
        $this->ipCountry = $ipCountry;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpRoutingMethod(){
        return $this->ipRoutingMethod;
    }

    /**
     * @param $ipRoutingMethod
     * 
     * @return @this
     */
    public function setIpRoutingMethod($ipRoutingMethod){
        $this->ipRoutingMethod = $ipRoutingMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpState(){
        return $this->ipState;
    }

    /**
     * @param $ipState
     * 
     * @return @this
     */
    public function setIpState($ipState){
        $this->ipState = $ipState;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreModelUsed(){
        return $this->scoreModelUsed;
    }

    /**
     * @param $scoreModelUsed
     * 
     * @return @this
     */
    public function setScoreModelUsed($scoreModelUsed){
        $this->scoreModelUsed = $scoreModelUsed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVelocityInfoCode(){
        return $this->velocityInfoCode;
    }

    /**
     * @param $velocityInfoCode
     * 
     * @return @this
     */
    public function setVelocityInfoCode($velocityInfoCode){
        $this->velocityInfoCode = $velocityInfoCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCasePriority(){
        return $this->casePriority;
    }

    /**
     * @param $casePriority
     * 
     * @return @this
     */
    public function setCasePriority($casePriority){
        $this->casePriority = $casePriority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderTransactionId(){
        return $this->providerTransactionId;
    }

    /**
     * @param $providerTransactionId
     * 
     * @return @this
     */
    public function setProviderTransactionId($providerTransactionId){
        $this->providerTransactionId = $providerTransactionId;
        return $this;
    }

}
