<?php

namespace BraspagSplit\Auth\API;

/**
 * Class Environment
 *
 * @package BraspagSplit\Auth\API
 */
class Environment implements \BraspagSplit\Environment
{
    private $api;

    /**
     * Environment constructor.
     *
     * @param $api
     * @param $apiQuery
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
        $api = 'https://authsandbox.braspag.com.br/';

        return new Environment($api);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api = 'https://auth.braspag.com.br/';
        
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
