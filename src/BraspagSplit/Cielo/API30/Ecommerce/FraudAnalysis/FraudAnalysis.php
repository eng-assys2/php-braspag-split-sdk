<?php

namespace BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis;

use BraspagSplit\Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class FraudAnalysis
 *
 * @package BraspagSplit\Cielo\API30\Ecommerce\FraudAnalysis
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

    // Reply Data

    private $fraudAnalysisReasonCode;

    private $isRetryTransaction;

    private $score;

    private $status;

    private $statusDescription;

    private $factorCode;

    private $id;

    private $previousStatus;

    private $providerTransactionId;

    private $transactionAmount;

    /** @var FraudAnalysisReplyData */
    private $replyData;

    
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
        return array_filter(get_object_vars($this));
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

        if (isset($data->Browser)) {
            $this->browser = new FraudAnalysisBrowser();
            $this->browser->populate($data->Browser);
        }

        if (isset($data->Cart)) {
            $this->cart = new FraudAnalysisCart();
            $this->cart->populate($data->Cart);
        }

        if (isset($data->MerchantDefinedFields)) {
            foreach ($data->MerchantDefinedFields as $merchantDefinedField) {
                $merchant = new FraudAnalysisMerchantDefinedFields();
                $merchant->populate($merchantDefinedField);    
                $this->merchantDefinedFields[] = $merchant;
            }      
        }

        if (isset($data->Shipping)) {
            $this->shipping = new FraudAnalysisShipping();
            $this->shipping->populate($data->Shipping);
        }

        if (isset($data->Travel)) {
            $this->travel = new FraudAnalysisTravel();
            $this->travel->populate($data->Travel);
        }

        if (isset($data->ReplyData)) {
            $this->replyData = new FraudAnalysisReplyData();
            $this->replyData->populate($data->ReplyData);
        }

        $this->fraudAnalysisReasonCode = isset($data->FraudAnalysisReasonCode) ? $data->FraudAnalysisReasonCode : null;
        $this->isRetryTransaction = isset($data->IsRetryTransaction) ? $data->IsRetryTransaction : null;
        $this->score = isset($data->Score) ? $data->Score : null;
        $this->status = isset($data->Status) ? $data->Status : null;
        $this->statusDescription = isset($data->StatusDescription) ? $data->StatusDescription : null;
        $this->factorCode = isset($data->FactorCode) ? $data->FactorCode : null;
        $this->id = isset($data->Id) ? $data->Id : null;
        $this->previousStatus = isset($data->PreviousStatus) ? $data->PreviousStatus : null;
        $this->providerTransactionId = isset($data->ProviderTransactionId) ? $data->ProviderTransactionId : null;
        $this->transactionAmount = isset($data->TransactionAmount) ? $data->TransactionAmount : null;

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
     * @param $ipAddress
     *
     * @return FraudAnalysisBrowser
     */
    public function browser($ipAddress){
        $browser = new FraudAnalysisBrowser($ipAddress);
        $this->browser = $browser;
        return $browser;
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
     * @param $ipAddress
     *
     * @return FraudAnalysisCart
     */
    public function cart($name, $quantity, $sku, $unitPrice){
        $item = new FraudAnalysisItem($name, $quantity, $sku, $unitPrice);
        $cart = new FraudAnalysisCart($item);
        $this->cart = $cart;
        return $cart;
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
     * @param $id
     * @param $value
     *
     * @return FraudAnalysisMerchantDefinedFields
     */
    public function merchantDefinedFields($id, $value)
    {
        $merchantDefinedFields = new FraudAnalysisMerchantDefinedFields($id, $value);
        $this->merchantDefinedFields[] = $merchantDefinedFields;

        return $merchantDefinedFields;
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
     * @param $addressee
     *
     * @return FraudAnalysisShipping
     */
    public function shipping($addressee)
    {
        $shipping = new FraudAnalysisShipping($addressee);
        $this->shipping = $shipping;

        return $shipping;
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
        return $this->travel;
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

    /**
     * @return mixed
     */
    public function getReplyData(){
        return $this->replyData;
    }

    /**
     * @param $replyData
     * 
     * @return $this
     */    
    public function setReplyData($replyData){
        $this->replyData = $replyData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFraudAnalysisReasonCode(){
        return $this->fraudAnalysisReasonCode;
    }

    /**
     * @param $fraudAnalysisReasonCode
     * 
     * @return $this
     */    
    public function setFraudAnalysisReasonCode($fraudAnalysisReasonCode){
        $this->fraudAnalysisReasonCode = $fraudAnalysisReasonCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsRetryTransaction(){
        return $this->isRetryTransaction;
    }

    /**
     * @param $isRetryTransaction
     * 
     * @return $this
     */    
    public function setIsRetryTransaction($isRetryTransaction){
        $this->isRetryTransaction = $isRetryTransaction;
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
     * @return $this
     */    
    public function setScore($score){
        $this->score = $score;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param $status
     * 
     * @return $this
     */    
    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusDescription(){
        return $this->statusDescription;
    }

    /**
     * @param $statusDescription
     * 
     * @return $this
     */    
    public function setStatusDescription($statusDescription){
        $this->statusDescription = $statusDescription;
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
     * @return $this
     */    
    public function setFactorCode($factorCode){
        $this->factorCode = $factorCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param $id
     * 
     * @return $this
     */    
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousStatus(){
        return $this->previousStatus;
    }

    /**
     * @param $previousStatus
     * 
     * @return $this
     */    
    public function setPreviousStatus($previousStatus){
        $this->previousStatus = $previousStatus;
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
     * @return $this
     */    
    public function setProviderTransactionId($providerTransactionId){
        $this->providerTransactionId = $providerTransactionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionAmount(){
        return $this->transactionAmount;
    }

    /**
     * @param $transactionAmount
     * 
     * @return $this
     */    
    public function setTransactionAmount($transactionAmount){
        $this->transactionAmount = $transactionAmount;
        return $this;
    }

}
