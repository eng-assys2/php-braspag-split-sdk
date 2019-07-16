<?php

namespace BraspagSplit\Onboarding\Api;

/**
 * Class Environment
 *
 * @package BraspagSplit\Onboarding\Api
 */
class Environment implements \BraspagSplit\Environment
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

        return new Environment($api);
    }

    /**
     * @return Environment
     */
    public static function production()
    {
        $api = 'https://splitonboarding.braspag.com.br/';

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
