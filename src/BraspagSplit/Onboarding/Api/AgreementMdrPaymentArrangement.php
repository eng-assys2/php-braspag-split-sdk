<?php

namespace BraspagSplit\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package BraspagSplit\Onboarding\API
 */
class AgreementMdrPaymentArrangement implements \JsonSerializable
{
    private $product;

    private $brand;

    /**
     * @param $json
     *
     * @return AgreementMdrPaymentArrangement
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $agreementMdrPaymentArrangement = new AgreementMdrPaymentArrangement();
        $agreementMdrPaymentArrangement->populate($object);

        return $agreementMdrPaymentArrangement;
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
        $this->product = isset($data->Product) ? $data->Product : null;
        $this->brand = isset($data->Brand) ? $data->Brand : null;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param $brand
     *
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

}
