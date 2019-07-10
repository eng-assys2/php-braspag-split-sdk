<?php

namespace Braspag\Split\API;

/**
 * Class SchedulerQuery
 *
 * @package Braspag\Split\API
 */
class SchedulerQuery implements \JsonSerializable
{
    /** @var date|null
     * Data inicial a ser consultada, considerando a data de captura das transações.
     * Formato: YYYY-MM-DD
     * Default: CurrentDate
     */
    private $initialCaptureDate;

    /** @var date|null
     * Data final a ser consultada, considerando a data de captura das transações.
     * Formato: YYYY-MM-DD
     * Default: InitialCaptureDate
     */
    private $finalCaptureDate;

    /** @var date|null
     * Data de pagamento prevista inicial a ser consultada.
     * Formato: YYYY-MM-DD
     * Default: CurrentDate
     */
    private $initialForecastedDate;

    /** @var date|null
     * Data de pagamento prevista final a ser consultada.
     * Formato: YYYY-MM-DD
     * Default: InitialForecastedDate
     */
    private $finalForecastedDate;
    
    /** @var date|null
     * Data de pagamento inicial a ser consultada.
     * Formato: YYYY-MM-DD
     */
    private $initialPaymentDate;

    /** @var date|null
     * Data de pagamento final a ser consultada.
     * Formato: YYYY-MM-DD
     * Default: InitialPaymentDate
     */
    private $finalPaymentDate;

    /** @var integer|null
     * Página a ser consultada.
     * Default: 1
     */
    private $pageIndex;

    /** @var integer|null
     * Default da página. Valores possíveis: 25, 50, 10
     * Default: 25
     */
    private $pageSize;

    /** @var string|null
     * Status do evento [Scheduled - Pending - Settled - Error - WaitingFoAdjustementDebit - Anticipated].
     * Default: Todos
     */
    private $eventStatus;

    /** @var bool|null
     * Incluir todos os subordinados na consulta.
     * Default: false
     */
    private $includeAllSubordinates;

    /** @var array|null
     * Lojas a serem consideradas na consulta.
     */
    private $merchantIds;


    /**
     * @param $json
     *
     * @return SchedulerQuery
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $schedulerQuery = new SchedulerQuery();
        $schedulerQuery->populate($object);

        return $schedulerQuery;
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
        $this->initialCaptureDate = isset($data->InitialCaptureDate) ? $data->InitialCaptureDate : null;
        $this->finalCaptureDate = isset($data->FinalCaptureDate) ? $data->FinalCaptureDate : null;

        $this->initialForecastedDate = isset($data->InitialForecastedDate) ? $data->InitialForecastedDate : null;
        $this->finalForecastedDate = isset($data->FinalForecastedDate) ? $data->FinalForecastedDate : null;
        
        $this->initialPaymentDate = isset($data->InitialPaymentDate) ? $data->InitialPaymentDate : null;
        $this->finalPaymentDate = isset($data->FinalPaymentDate) ? $data->FinalPaymentDate : null;

        $this->pageIndex = isset($data->PageIndex) ? $data->PageIndex : null;
        $this->pageSize = isset($data->PageSize) ? $data->PageSize : null;
        $this->eventStatus = isset($data->EventStatus) ? $data->EventStatus : null;
        $this->includeAllSubordinates = isset($data->IncludeAllSubordinates) ? $data->IncludeAllSubordinates : null;
        $this->merchantIds = isset($data->MerchantIds) ? $data->MerchantIds : [];
    }

    /**
     * @return string
     */
    public function getQueryParams()
    {
        $query = "";
        $query_params = array_filter($this->jsonSerialize());

        foreach ($query_params as $key => $value) {
            $query .=  "{$key}={$value}&";
        }
        
        return rtrim($query,'&');
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
    public function getInitialCaptureDate(){
        return $this->initialCaptureDate;
    }

    /**
     * @param $initialCaptureDate
     * @return $this
     */
    public function setInitialCaptureDate($initialCaptureDate){
        $this->initialCaptureDate = $initialCaptureDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinalCaptureDate(){
        return $this->finalCaptureDate;
    }

    /**
     * @param $finalCaptureDate
     * @return $this
     */
    public function setFinalCaptureDate($finalCaptureDate){
        $this->finalCaptureDate = $finalCaptureDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInitialForecastedDate(){
        return $this->initialForecastedDate;
    }

    /**
     * @param $initialForecastedDate
     * @return $this
     */
    public function setInitialForecastedDate($initialForecastedDate){
        $this->initialForecastedDate = $initialForecastedDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinalForecastedDate(){
        return $this->finalForecastedDate;
    }

    /**
     * @param $finalForecastedDate
     * @return $this
     */
    public function setFinalForecastedDate($finalForecastedDate){
        $this->finalForecastedDate = $finalForecastedDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInitialPaymentDate(){
        return $this->initialPaymentDate;
    }

    /**
     * @param $initialPaymentDate
     * @return $this
     */
    public function setInitialPaymentDate($initialPaymentDate){
        $this->initialPaymentDate = $initialPaymentDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinalPaymentDate(){
        return $this->finalPaymentDate;
    }

    /**
     * @param $finalPaymentDate
     * @return $this
     */
    public function setFinalPaymentDate($finalPaymentDate){
        $this->finalPaymentDate = $finalPaymentDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageIndex(){
        return $this->pageIndex;
    }

    /**
     * @param $pageIndex
     * @return $this
     */
    public function setPageIndex($pageIndex){
        $this->pageIndex = $pageIndex;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageSize(){
        return $this->pageSize;
    }

    /**
     * @param $pageSize
     * @return $this
     */
    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
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
     * @return $this
     */
    public function setEventStatus($eventStatus){
        $this->eventStatus = $eventStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIncludeAllSubordinates(){
        return $this->includeAllSubordinates;
    }

    /**
     * @param $includeAllSubordinates
     * @return $this
     */
    public function setIncludeAllSubordinates($includeAllSubordinates){
        $this->includeAllSubordinates = $includeAllSubordinates;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMerchantIds(){
        return $this->merchantIds;
    }

    /**
     * @param $merchantIds
     * @return $this
     */
    public function setMerchantIds($merchantIds){
        $this->merchantIds = $merchantIds;
        return $this;
    }

}
