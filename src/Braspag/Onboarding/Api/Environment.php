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
        $api = 'https://splitonboardingsandbox.braspag.com.br/';

        return new Environment($api, $apiQuery, $braspagAuth, $apiBraspagSplit);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api = 'https://splitonboarding.braspag.com.br/';

        return new Environment($api, $apiQuery, $braspagAuth, $apiBraspagSplit);
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

    /**
     * Gets the environment's Api Query URL
     *
     * @return string Api Query URL
     */
    public function getApiQueryURL()
    {
        return $this->apiQuery;
    }

    /**
     * Gets the environment's Braspag Auth URL
     *
     * @return string Braspag Auth URL
     */
    public function getbraspagAuthURL(){
        return $this->braspagAuth;
    }

    /**
     * Gets the environment's Api Braspag Split URL
     *
     * @return string Api Braspag Split URL
     */
    public function getapiBraspagSplitURL(){
        return $this->apiBraspagSplit;
    }
}
