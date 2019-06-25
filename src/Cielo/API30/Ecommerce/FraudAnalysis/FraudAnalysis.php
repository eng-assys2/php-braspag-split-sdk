<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysis
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysis implements CieloSerializable
{
    /** @var string Fixo "cybersource" */
    private $provider;

    /** @var string Tipo de Fluxo para realização da análise de fraude. 
     * Primeiro Analise (AnalyseFirst) ou 
     * Primeiro Autorização (AuthorizeFirst) 
     * */
    private $sequence;

    /** @var string Critério do fluxo. 
     * OnSuccess - Só realiza a análise se tiver sucesso na transação. 
     * Always - Sempre realiza a análise 
     * */
    private $sequenceCriteria;

    /** @var boolean|null 
     * Quando true, a autorização deve ser com captura automática quando o risco de fraude for considerado baixo (Accept).
     * Em casos de Reject ou Review, o fluxo permanece o mesmo, ou seja, a captura acontecerá conforme o valor especificado no parâmetro "Capture".
     * Para a utilização deste parâmetro, a sequência do fluxo de análise de risco deve ser obrigatoriamente "AuthorizeFirst".
     * */
    private $captureOnLowRisk;

    /** @var boolean|null Quando true, o estorno deve acontecer automaticamente quando o risco de fraude for considerado alto (Reject).
     * Em casos de Accept ou Review, o fluxo permanece o mesmo, ou seja, o estorno deve ser feito manualmente. 
     * Para a utilização deste parâmetro, a sequência do fluxo de análise de risco deve ser obrigatoriamente "AuthorizeFirst".
     * */
    private $voidOnHighRisk;

    /** @var double Valor total do pedido. */
    private $totalOrderAmount;

    /** @var string Identificador utilizado para cruzar informações obtidas pelo Browser do internauta com os dados enviados para análise.
     * Este mesmo valor deve ser passado na variável SESSIONID do script do DeviceFingerPrint
     * */
    private $fingerPrintId;

    /** @var FraudAnalysisBrowser */
    private $browser;

    /** @var FraudAnalysisCart */
    private $cart;

    /** @var FraudAnalysisMerchantDefinedFields */
    private $merchantDefinedFields;

    /** @var FraudAnalysisShipping */
    private $shipping;

    /** @var FraudAnalysisTravel */
    private $travel;
    
    /**
     * FraudAnalysis constructor.
     *
     */
    public function __construct($provider="cybersource",
                                $sequence="AuthorizeFirst", // AnalyseFirst, AuthorizeFirst
                                $sequenceCriteria="OnSuccess", // OnSuccess, Always
                                $captureOnLowRisk=false,
                                $voidOnHighRisk=false,
                                $totalOrderAmount=0,
                                $fingerPrintId=null,
                                $browser=null,
                                $cart=null,
                                $merchantDefinedFields=null,
                                $shipping=null,
                                $travel=null)
    {
        $this->provider=$provider;
        $this->sequence=$sequence;
        $this->sequenceCriteria=$sequenceCriteria;
        $this->captureOnLowRisk=$captureOnLowRisk;
        $this->voidOnHighRisk=$voidOnHighRisk;
        $this->totalOrderAmount=$totalOrderAmount;
        $this->fingerPrintId=$fingerPrintId;
        $this->browser=$browser;
        $this->cart=$cart;
        $this->merchantDefinedFields=$merchantDefinedFields;
        $this->shipping=$shipping;
        $this->travel=$travel;
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
