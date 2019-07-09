<?php

namespace Braspag\Split\API;

/**
 * Class Environment
 *
 * @package Braspag\Split\API
 */
class Environment implements \Braspag\Environment
{
    private $api;

    /**
     * Environment constructor.
     *
     * @param $api
     */
    private function __construct($api)
    {
        $this->api = $api;
    }

    /**
     * @return Environment
     */
    public static function sandbox()
    {
        $api = 'https://splitsandbox.braspag.com.br/';
        return new Environment($api);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api = 'https://split.braspag.com.br/';
        return new Environment($api);
    }

    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl()
    {
        return $this->api;
    }
}
