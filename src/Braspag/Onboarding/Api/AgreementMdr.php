<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class AgreementMdr implements \JsonSerializable
{
    private $initialInstallmentNumber;
    private $finalInstallmentNumber;
    private $percent;
    private $paymentArrangement;


    /**
     * @param $json
     *
     * @return AgreementMdr
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $agreementMdr = new AgreementMdr();
        $agreementMdr->populate($object);

        return $agreementMdr;
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
        $this->initialInstallmentNumber = isset($data->InitialInstallmentNumber) ? $data->InitialInstallmentNumber : null;
        $this->finalInstallmentNumber = isset($data->FinalInstallmentNumber) ? $data->FinalInstallmentNumber : null;
        $this->percent = isset($data->Percent) ? $data->Percent : null;

        $this->paymentArrangement = isset($data->PaymentArrangement) ? (new AgreementMdrPaymentArrangement())->populate($data->PaymentArrangement) : null;
    }

    /**
     * @return mixed
     */
    public function getInitialInstallmentNumber()
    {
        return $this->initialInstallmentNumber;
    }

    /**
     * @param $initialInstallmentNumber
     *
     * @return $this
     */
    public function setInitialInstallmentNumber($initialInstallmentNumber)
    {
        $this->initialInstallmentNumber = $initialInstallmentNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinalInstallmentNumber()
    {
        return $this->finalInstallmentNumber;
    }

    /**
     * @param $finalInstallmentNumber
     *
     * @return $this
     */
    public function setFinalInstallmentNumber($finalInstallmentNumber)
    {
        $this->finalInstallmentNumber = $finalInstallmentNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param $percent
     *
     * @return $this
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentArrangement()
    {
        return $this->paymentArrangement;
    }

    /**
     * @param $paymentArrangement
     *
     * @return $this
     */
    public function setPaymentArrangement($paymentArrangement)
    {
        $this->paymentArrangement = $paymentArrangement;

        return $this;
    }

}
