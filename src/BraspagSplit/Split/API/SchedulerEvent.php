<?php

namespace BraspagSplit\Split\API;

/**
 * Class SchedulerEvent
 *
 * @package BraspagSplit\Split\API
 */
class SchedulerEvent implements \JsonSerializable
{
    /** @var guid
     * Identificador do evento na agenda financeIra.
     * Tamanho: 36
     */
    private $id;

    /** @var guid
     * Identificador da transação.
     * Tamanho: 36
     */
    private $paymentId;

    /** @var guid
     * Identificador da loja.
     * Tamanho: 36
     */
    private $merchantId ;

    /** @var date
     * Data de liquidação. Retornada somente quando pagamento realizado (EventStatus = Settled)
     * Formato: YYYY-MM-DD
     */
    private $paymentDate;

    /** @var date
     * Data de liquidação prevista.
     * Formato: YYYY-MM-DD
     */
    private $forecastedDate;

    /** @var integer
     * Número de parcelas da transação.
     */
    private $installments;

    /** @var integer
     * Valor, em centavos, da parcela a liquidar.
     */
    private $installmentAmount;

    /** @var integer
     * Número da parcela a liquidar.
     */
    private $installmentNumber;

    /** @var integer
     * 	Identificador do evento.
     * Valores possíveis para Cartão de Crédito: 
     * '1' - Credit
     * '3' - FeeCredit
     * '5' - RefundCredit
     * '7' - ChargebackCredit
     * '9' - UndoChargebackCredit
     * '11' - AntiFraudFeeCredit
     * '13' - AntiFraudFeeWithReviewCredit
     * '15' - AdjustmentCredit
     * '17' - ChargebackReversalCredit
     * '19' - AnticipationCredit
     * '20' - AnticipationCommissionCredit
     * 
     * Valores possíveis para Cartão de Débito: 
     * '2' - Debit
     * '4' - FeeDebit
     * '6' - RefundDebit
     * '8' - ChargebackDebit
     * '10' - UndoChargebackDebit
     * '12' - AntiFraudFeeDebit
     * '14' - AntiFraudFeeWithReviewDebit
     * '16' - AdjustmentDebit
     * '18' - ChargebackReversalDebit
     * '22' - AnticipationCommissionDebit
     */
    private $event;

    /** @var string
     * Descrição do Evento
     * Valores possíveis para Cartão de Crédito: 
     * 1 - 'Credit'
     * 3 - 'FeeCredit'
     * 5 - 'RefundCredit'
     * 7 - 'ChargebackCredit'
     * 9 - 'UndoChargebackCredit'
     * 11 - 'AntiFraudFeeCredit'
     * 13 - 'AntiFraudFeeWithReviewCredit'
     * 15 - 'AdjustmentCredit'
     * 17 - 'ChargebackReversalCredit'
     * 19 - 'AnticipationCredit'
     * 20 - 'AnticipationCommissionCredit'
     * 
     * Valores possíveis para Cartão de Débito: 
     * 2 - 'Debit'
     * 4 - 'FeeDebit'
     * 6 - 'RefundDebit'
     * 8 - 'ChargebackDebit'
     * 10 - 'UndoChargebackDebit'
     * 12 - 'AntiFraudFeeDebit'
     * 14 - 'AntiFraudFeeWithReviewDebit'
     * 16 - 'AdjustmentDebit'
     * 18 - 'ChargebackReversalDebit'
     * 22 - 'AnticipationCommissionDebit'
     */
    private $eventDescription;

    /** @var string
     * Status do Evento na Agenda Financeira
     * Um evento poderá estar em um dos seguintes status na agenda financeira:
     * 'Scheduled' - Agendado.
     * 'Pending' - Aguardando confirmação de liquidação.
     * 'Settled' - Liquidado.
     * 'Error' - Erro de liquidação na instituição financeira.
     * 'WaitingForAdjustementDebit' - Aguardando liquidação do ajuste de débito associado.
     * 'Anticipated' - Evento antecipado.
     */
    private $eventStatus;

    /** @var guid
     * Merchant ID da Conta Principal
     */
    private $sourceId;

    /** @var double
     * Mdr aplicado
     */
    private $mdr;

    /** @var boolean
     */
    private $commission;

    /**
     * @param $json
     *
     * @return SchedulerEvent
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $schedulerEvent = new SchedulerEvent();
        $schedulerEvent->populate($object);

        return $schedulerEvent;
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
        $this->id = isset($data->Id) ? $data->Id : null;
        $this->paymentId = isset($data->PaymentId) ? $data->PaymentId : null;
        $this->merchantId  = isset($data->MerchantId) ? $data->MerchantId : null;
        $this->paymentDate = isset($data->PaymentDate) ? $data->PaymentDate : null;
        $this->forecastedDate = isset($data->ForecastedDate) ? $data->ForecastedDate : null;
        $this->installments = isset($data->Installments) ? $data->Installments : null;
        $this->installmentAmount = isset($data->InstallmentAmount) ? $data->InstallmentAmount : null;
        $this->installmentNumber = isset($data->InstallmentNumber) ? $data->InstallmentNumber : null;
        $this->event = isset($data->Event) ? $data->Event : null;
        $this->eventDescription = isset($data->EventDescription) ? $data->EventDescription : null;
        $this->eventStatus = isset($data->EventStatus) ? $data->EventStatus : null;
        $this->sourceId = isset($data->SourceId) ? $data->SourceId : null;
        $this->mdr = isset($data->Mdr) ? $data->Mdr : null;
        $this->commission = isset($data->Commission) ? $data->Commission : null;

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
    */
    public function getPaymentId(){
        return $this->paymentId;
    }

    /**
     * @param $paymentId
     * 
     * @return $this
     */
    public function setPaymentId($paymentId){
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getMerchantId(){
        return $this->merchantId;
    }

    /**
     * @param $merchantId
     * 
     * @return $this
     */
    public function setMerchantId($merchantId){
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getPaymentDate(){
        return $this->paymentDate;
    }

    /**
     * @param $paymentDate
     * 
     * @return $this
     */
    public function setPaymentDate($paymentDate){
        $this->paymentDate = $paymentDate;
        return $this;
    }

    /**
    * @return mixed
    */    
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
    */    
    public function getInstallments(){
        return $this->installments;
    }

    /**
     * @param $installments
     * 
     * @return $this
     */
    public function setInstallments($installments){
        $this->installments = $installments;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getInstallmentAmount(){
        return $this->installmentAmount;
    }

    /**
     * @param $installmentAmount
     * 
     * @return $this
     */
    public function setInstallmentAmount($installmentAmount){
        $this->installmentAmount = $installmentAmount;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getInstallmentNumber(){
        return $this->installmentNumber;
    }

    /**
     * @param $installmentNumber
     * 
     * @return $this
     */
    public function setInstallmentNumber($installmentNumber){
        $this->installmentNumber = $installmentNumber;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getEvent(){
        return $this->event;
    }

    /**
     * @param $event
     * 
     * @return $this
     */
    public function setEvent($event){
        $this->event = $event;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getEventDescription(){
        return $this->eventDescription;
    }

    /**
     * @param $eventDescription
     * 
     * @return $this
     */
    public function setEventDescription($eventDescription){
        $this->eventDescription = $eventDescription;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getEventStatus(){
        return $this->eventStatus;
    }

    /**
     * @param $eventStatus
     * 
     * @return $this
     */
    public function setEventStatus($eventStatus){
        $this->eventStatus = $eventStatus;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getSourceId(){
        return $this->sourceId;
    }

    /**
     * @param $sourceId
     * 
     * @return $this
     */
    public function setSourceId($sourceId){
        $this->sourceId = $sourceId;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getMdr(){
        return $this->mdr;
    }

    /**
     * @param $mdr
     * 
     * @return $this
     */
    public function setMdr($mdr){
        $this->mdr = $mdr;
        return $this;
    }

    /**
    * @return mixed
    */    
    public function getCommission(){
        return $this->commission;
    }

    /**
     * @param $commission
     * 
     * @return $this
     */
    public function setCommission($commission){
        $this->commission = $commission;
        return $this;
    }

}
