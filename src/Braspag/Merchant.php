<?php

namespace Braspag;

/**
 * Class Merchant
 *
 * @package Braspag
 */
class Merchant
{
    private $token;

    /**
     * Merchant constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token  = $token;
    }

    /**
     * Gets the merchant token
     *
     * @return string the merchant token on Braspag
     */
    public function getToken()
    {
        return $this->token;
    }
}
