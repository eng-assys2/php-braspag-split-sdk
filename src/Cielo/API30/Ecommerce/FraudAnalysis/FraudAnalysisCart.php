<?php

namespace Cielo\API30\Ecommerce\FraudAnalysis;

/**
 * Class FraudAnalysisCart
 *
 * @package Cielo\API30\Ecommerce\FraudAnalysis
 */
class FraudAnalysisCart implements CieloSerializable
{
    /** @var boolean|null Booleano que indica se o pedido é para presente ou não. */
    private $isGift;
    /** @var boolean|null 	Booleano que define se devoluções são aceitas para o pedido. */
    private $returnsAccepted;
    /** @var FraudAnalysisItems */
    private $items;

    /**
     * FraudAnalysisCart constructor.
     *
     */
    public function __construct($items,
                                $isGift=false,
                                $returnsAccepted=false)
    {
        $this->isGift = $isGift;
        $this->returnsAccepted = $returnsAccepted;
        $this->items = $items;
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
        $this->isGift = isset($data->IsGift) ? $data->IsGift : null;
        $this->returnsAccepted = isset($data->ReturnsAccepted) ? $data->ReturnsAccepted : null;
        $this->items = isset($data->Items) ? $data->Items : null;
    }

    /**
     * @return mixed
     */
    public function getIsGift()
    {
        return $this->isGift;
    }

    /**
     * @param $isGift
     *
     * @return $this
     */
    public function setIsGift($isGift)
    {
        $this->isGift = $isGift;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnsAccepted()
    {
        return $this->returnsAccepted;
    }

    /**
     * @param $returnsAccepted
     *
     * @return $this
     */
    public function setReturnsAccepted($returnsAccepted)
    {
        $this->returnsAccepted = $returnsAccepted;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }
}
