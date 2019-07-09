<?php

namespace Braspag\Cielo\API30\Ecommerce;

/**
 * Class Environment
 *
 * @package Braspag\Cielo\API30\Ecommerce
 */
class Environment implements \Cielo\API30\Environment
{
    private $api;

    private $apiQuery;

    private $braspagAuth;

    private $apiBraspagSplit;

    /**
     * Environment constructor.
     *
     * @param $api
     * @param $apiQuery
     */
    private function __construct($api, $apiQuery, $braspagAuth, $apiBraspagSplit)
    {
        $this->api      = $api;
        $this->apiQuery = $apiQuery;
        $this->braspagAuth = $braspagAuth;
        $this->apiBraspagSplit = $apiBraspagSplit;
    }

    /**
     * @return Environment
     */
    public static function sandbox()
    {
        $api      = 'https://apisandbox.cieloecommerce.cielo.com.br/';
        $apiQuery = 'https://apiquerysandbox.cieloecommerce.cielo.com.br/';
        $braspagAuth = 'https://authsandbox.braspag.com.br/';
        $apiBraspagSplit = 'https://splitsandbox.braspag.com.br/';

        return new Environment($api, $apiQuery, $braspagAuth, $apiBraspagSplit);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api      = 'https://api.cieloecommerce.cielo.com.br/';
        $apiQuery = 'https://apiquery.cieloecommerce.cielo.com.br/';
        $braspagAuth = ' https://auth.braspag.com.br/';
        $apiBraspagSplit = 'https://split.braspag.com.br/';

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
