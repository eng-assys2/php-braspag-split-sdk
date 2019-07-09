<?php

namespace Braspag\Cielo\API30\Ecommerce;

/**
 * Interface CieloSerializable
 *
 * @package Braspag\Cielo\API30\Ecommerce
 */
interface CieloSerializable extends \JsonSerializable
{
    /**
     * @param \stdClass $data
     *
     * @return mixed
     */
    public function populate(\stdClass $data);
}
