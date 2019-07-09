<?php

namespace Cielo\API30;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;

/**
 * Class Merchant
 *
 * @package Cielo\API30
 */
class Merchant
{
    private $id;
    private $key;
    private $accessToken;

    /**
     * Merchant constructor.
     *
     * @param $id
     * @param $key
     */
    public function __construct($id, $key)
    {
        $this->id  = $id;
        $this->key = $key;
    }

    /**
     * Gets the merchant identification number
     *
     * @return string the merchant identification number on Cielo
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the merchant identification key
     *
     * @return string the merchant identification key on Cielo
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the access token
     *
     * @return void
     */
    public function setAccessToken(){
        if (!isset($this->accessToken)){
            $this->accessToken = $this->authBraspag();
        }
    }

    /**
     * Gets the access token
     *
     * @return string the access token on Cielo by Braspag OAuth2
     */
    public function getAccessToken(){
        if (!isset($this->accessToken)){
            $this->setAccessToken();
        }
        return $this->accessToken;
    }

    private function authBraspag(){
        $client = new GuzzleClient();
        try {
            $callback = $client->post('https://authsandbox.braspag.com.br/oauth2/token',
                [
                    'http_errors' => false,
                    'auth' => [
                        $this->id,
                        $this->key
                    ],
                    'headers' => [
                        'Accept: application/json',
                        'User-Agent: CieloEcommerce/3.0 PHP SDK',
                        "Authorization: Basic " . base64_encode($this->id.':'.$this->key)
                    ],
                    'form_params' => [
                        'grant_type' => 'client_credentials'
                    ]
                ]
            );

            $callback_decoded = json_decode($callback->getBody(), true);

            return $callback_decoded['access_token'];

        } catch (ConnectException $ex) {
            return null;
        }
    }

}
