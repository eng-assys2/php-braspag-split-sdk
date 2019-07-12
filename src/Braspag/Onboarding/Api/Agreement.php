<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class Agreement implements \JsonSerializable
{
    private $fee;

    private $merchantDiscountRates;
    
    /**
     * @param $json
     *
     * @return Agreement
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $Agreement = new Agreement();
        $Agreement->populate($object);

        return $Agreement;
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

        $this->fee = isset($data->id) ? $data->id : null;

        $this->merchantDiscountRates = [];
        if (isset($data->MerchantDiscountRates)) {
            foreach ($data->MerchantDiscountRates as $merchantDiscountRates) {
                $merchantDiscountRate = new AgreementMdr();
                $merchantDiscountRate->populate($merchantDiscountRates);    
                $this->merchantDiscountRates[] = $merchantDiscountRate;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param $fee
     *
     * @return $this
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getmerchantDiscountRates()
    {
        return $this->merchantDiscountRates;
    }

    /**
     *
     * @return AgreementMdr
     */
    public function merchantDiscountRate()
    {
        $merchantDiscountRate = new AgreementMdr();
        $this->merchantDiscountRates[] = $merchantDiscountRate;

        return $merchantDiscountRate;
    }

    /**
     * @param $merchantDiscountRates
     *
     * @return $this
     */
    public function setmerchantDiscountRates($merchantDiscountRates)
    {
        $this->merchantDiscountRates = $merchantDiscountRates;

        return $this;
    }

}
