<?php

namespace BraspagSplit\Split\API;

/**
 * Class SchedulerAdjustment
 *
 * @package BraspagSplit\Split\API
 */
class SchedulerAdjustment implements \JsonSerializable
{
    /** @var guid
     * Identificador do Ajuste
     * Tamanho: 36
     */
    private $id;

    /** @var guid
     * Status do ajustes. Valores possíveis:
     * Created
     * Scheduled
     * Processed
     * Canceled
     */
    private $status;

    /** @var guid
     * Merchant do qual o valor será debitado.
     * Tamanho: 36
     */
    private $merchantIdToDebit;

    /** @var integer
     * Merchant para o qual o valor será creditado.
     */
    private $merchantIdToCredit;

    /** @var string
     * 	Data prevista para lançamento do ajuste na agenda financeira.
     */
    private $forecastedDate;

    /** @var integer
     * Valor em centavos do ajuste.
     */
    private $amount;

    /** @var string
     * Decrição do ajuste.
     */
    private $description;

    /** @var guid|null
     * Identificador da transação para qual o ajuste está sendo lançado.
     * Ao associar o ajuste a uma transação, os envolvidos devem ser participantes da transação.
     */
    private $transactionId;

    /**
     * @param $json
     *
     * @return SchedulerAdjustment
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $schedulerAdjustment = new SchedulerAdjustment();
        $schedulerAdjustment->populate($object);

        return $schedulerAdjustment;
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
        $this->id = isset($data->id) ? $data->id : null;
        $this->status = isset($data->status) ? $data->status : null;
        $this->merchantIdToDebit = isset($data->merchantIdToDebit) ? $data->merchantIdToDebit : null;
        $this->merchantIdToCredit = isset($data->merchantIdToCredit) ? $data->merchantIdToCredit : null;
        $this->forecastedDate = isset($data->forecastedDate) ? $data->forecastedDate : null;
        $this->amount = isset($data->amount) ? $data->amount : null;
        $this->description = isset($data->description) ? $data->description : null;
        $this->transactionId = isset($data->transactionId) ? $data->transactionId : null;
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
     * */
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
     * */
    public function getMerchantIdToDebit(){
        return $this->merchantIdToDebit;
    }

    /**
     * @param $merchantIdToDebit
     * 
     * @return $this
     */
    public function setMerchantIdToDebit($merchantIdToDebit){
        $this->merchantIdToDebit = $merchantIdToDebit;
        return $this;
    }

    /**
     * @return mixed
     * */
    public function getMerchantIdToCredit(){
        return $this->merchantIdToCredit;
    }

    /**
     * @param $merchantIdToCredit
     * 
     * @return $this
     */
    public function setMerchantIdToCredit($merchantIdToCredit){
        $this->merchantIdToCredit = $merchantIdToCredit;
        return $this;
    }

    /**
     * @return mixed
     * */
    public function getForecastedDate(){
        return $this->forecastedDate;
    }

    /**
     * @param $forecastedDate
     * 
     * @return $this
     */
    public function setForecastedDate($forecastedDate){
        $this->forecastedDate = $forecastedDate;
        return $this;
    }

    /**
     * @return mixed
     * */
    public function getAmount(){
        return $this->amount;
    }

    /**
     * @param $amount
     * 
     * @return $this
     */
    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     * */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @param $description
     * 
     * @return $this
     */
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     * */
    public function getTransactionId(){
        return $this->transactionId;
    }

    /**
     * @param $transactionId
     * 
     * @return $this
     */
    public function setTransactionId($transactionId){
        $this->transactionId = $transactionId;
        return $this;
    }

}
