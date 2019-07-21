<?php

namespace BraspagSplit\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package BraspagSplit\Onboarding\API
 */
class SubordinateMerchant implements \JsonSerializable
{
    /** @var guid
     * Razão social
     * Tamanho: 36
     */
    private $corporateName;
    
    /** @var string
     * Nome fantasia
     * Tamanho: 50
     */
    private $fancyName;	

    /** @var string
     * Número do documento (Apenas números)
     * Tamanho: 14
     */
    private $documentNumber;	
    
    /** @var string
     * Tipo do documento. Os tipos válidos são Cpf, Cnpj
     * Tamanho: -
     */
    private $documentType;	
    
    /** @var string
     * (MCC) número registrado na ISO 18245 para serviços financeiros de varejo,
     * utilizado para classificar o negócio pelo tipo fornecido de bens ou serviços. 
     * Tamanho: 4
     */
    private $merchantCategoryCode;	
    
    /** @var string
     * Nome do contato responsável
     * Tamanho: 100
     */
    private $contactName;	
    
    /** @var string
     * Número do telefone do contato responsável (Apenas números)
     * Tamanho: 11
     */
    private $contactPhone;	
    
    /** @var string|null
     * Endereço de e-mail
     * Tamanho: 50
     */

    private $mailAddress;	
    
    /** @var string|null 
     * Endereço do website
     * Tamanho: 200
     */
    private $website;	

    /** @var SubordinateBankAccount */
    private $bankAccount;

    /** @var SubordinateAddress */
    private $address;

    /** @var SubordinateNotification */
    private $notification;

    /** @var Attachment[] */
    private $attachments;

    /**
     * @param $json
     *
     * @return SubordinateMerchant
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new SubordinateMerchant();
        $auth->populate($object);

        return $auth;
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
        $this->corporateName = isset($data->CorporateName) ? $data->CorporateName : null;
        $this->fancyName = isset($data->FancyName) ? $data->FancyName : null;
        $this->documentNumber = isset($data->DocumentNumber) ? $data->DocumentNumber : null;
        $this->documentType = isset($data->DocumentType) ? $data->DocumentType : null;
        $this->merchantCategoryCode = isset($data->MerchantCategoryCode) ? $data->MerchantCategoryCode : null;
        $this->contactName = isset($data->ContactName) ? $data->ContactName : null;
        $this->contactPhone = isset($data->ContactPhone) ? $data->ContactPhone : null;
        $this->mailAddress = isset($data->MailAddress) ? $data->MailAddress : null;
        $this->website = isset($data->Website) ? $data->Website : null;

        $this->bankAccount = isset($data->BankAccount) ? $data->BankAccount : null;
        $this->address = isset($data->Address) ? $data->Address : null;
        $this->notification = isset($data->Notification) ? $data->Notification : null;

        $this->attachments = [];
        if (isset($data->Attachments)) {
            foreach ($data->Attachments as $attachments) {
                $attachment = new Attachment();
                $attachment->populate($attachments);    
                $this->attachments[] = $attachment;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getCorporateName(){
        return $this->corporateName;
    }

    /**
     * @param $corporateName
     * @return $this
     */
    public function setCorporateName($corporateName){
        $this->corporateName = $corporateName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFancyName(){
        return $this->fancyName;
    }

    /**
     * @param $fancyName
     * @return $this
     */
    public function setFancyName($fancyName){
        $this->fancyName = $fancyName;
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
     * @return $this
     */
    public function setDocumentType($documentType){
        $this->documentType = $documentType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMerchantCategoryCode(){
        return $this->merchantCategoryCode;
    }

    /**
     * @param $merchantCategoryCode
     * @return $this
     */
    public function setMerchantCategoryCode($merchantCategoryCode){
        $this->merchantCategoryCode = $merchantCategoryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactName(){
        return $this->contactName;
    }

    /**
     * @param $contactName
     * @return $this
     */
    public function setContactName($contactName){
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactPhone(){
        return $this->contactPhone;
    }

    /**
     * @param $contactPhone
     * @return $this
     */
    public function setContactPhone($contactPhone){
        $this->contactPhone = $contactPhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMailAddress(){
        return $this->mailAddress;
    }

    /**
     * @param $mailAddress
     * @return $this
     */
    public function setMailAddress($mailAddress){
        $this->mailAddress = $mailAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite(){
        return $this->website;
    }

    /**
     * @param $website
     * @return $this
     */
    public function setWebsite($website){
        $this->website = $website;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankAccount(){
        return $this->bankAccount;
    }

    /**
     * @param $bankAccount
     * @return $this
     */
    public function setBankAccount($bankAccount){
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress(){
        return $this->address;
    }

    /**
     * @param $address
     * @return $this
     */
    public function setAddress($address){
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotification(){
        return $this->notification;
    }

    /**
     * @param $notification
     * @return $this
     */
    public function setNotification($notification){
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttachments(){
        return $this->attachments;
    }

    /**
     *
     * @return Attachment
     */
    public function attachment()
    {
        $attachment = new Attachment();
        $this->attachments[] = $attachment;

        return $attachment;
    }

    /**
     * @param $attachments
     * @return $this
     */
    public function setAttachments($attachments){
        $this->attachments = $attachments;
        return $this;
    }

}
