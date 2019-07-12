<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class BankAccount implements \JsonSerializable
{
    private $bank;
    private $bankAccountType;
    private $number;
    private $operation;
    private $verifierDigit;
    private $agencyNumber;
    private $agencyDigit;
    private $documentNumber;
    private $documentType;

    /**
     * @param $json
     *
     * @return BankAccount
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $bankAccount = new BankAccount();
        $bankAccount->populate($object);

        return $bankAccount;
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
        $this->bank = isset($data->Bank) ? $data->Bank : null;
        $this->bankAccountType = isset($data->BankAccountType) ? $data->BankAccountType : null;
        $this->number = isset($data->Number) ? $data->Number : null;
        $this->operation = isset($data->Operation) ? $data->Operation : null;
        $this->verifierDigit = isset($data->VerifierDigit) ? $data->VerifierDigit : null;
        $this->agencyNumber = isset($data->AgencyNumber) ? $data->AgencyNumber : null;
        $this->agencyDigit = isset($data->AgencyDigit) ? $data->AgencyDigit : null;
        $this->documentNumber = isset($data->DocumentNumber) ? $data->DocumentNumber : null;
        $this->documentType = isset($data->DocumentType) ? $data->DocumentType : null;
    }

    /**
     * @return mixed
     */
    public function getBank(){
        return $this->bank;
    }

    /**
     * @param $bank
     *
     * @return $this
     */
    public function setBank($bank){
        $this->bank = $bank;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getBankAccountType(){
        return $this->bankAccountType;
    }

    /**
     * @param $bankAccountType
     *
     * @return $this
     */
    public function setBankAccountType($bankAccountType){
        $this->bankAccountType = $bankAccountType;
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
    public function getOperation(){
        return $this->operation;
    }

    /**
     * @param $operation
     *
     * @return $this
     */
    public function setOperation($operation){
        $this->operation = $operation;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getVerifierDigit(){
        return $this->verifierDigit;
    }

    /**
     * @param $verifierDigit
     *
     * @return $this
     */
    public function setVerifierDigit($verifierDigit){
        $this->verifierDigit = $verifierDigit;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAgencyNumber(){
        return $this->agencyNumber;
    }

    /**
     * @param $agencyNumber
     *
     * @return $this
     */
    public function setAgencyNumber($agencyNumber){
        $this->agencyNumber = $agencyNumber;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAgencyDigit(){
        return $this->agencyDigit;
    }

    /**
     * @param $agencyDigit
     *
     * @return $this
     */
    public function setAgencyDigit($agencyDigit){
        $this->agencyDigit = $agencyDigit;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDocumentNumber(){
        return $this->documentNumber;
    }

    /**
     * @param $documentNumber
     *
     * @return $this
     */
    public function setDocumentNumber($documentNumber){
        $this->documentNumber = $documentNumber;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDocumentType(){
        return $this->documentType;
    }

    /**
     * @param $documentType
     *
     * @return $this
     */
    public function setDocumentType($documentType){
        $this->documentType = $documentType;
        return $this;
    }

}
