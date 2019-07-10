<?php

namespace Braspag\Auth\API;

/**
 * Class Token
 *
 * @package Braspag\Auth\API
 */
class Token implements \JsonSerializable
{
    /** @var string|null 
     * Token de Acesso Gerado pela Braspag
     */
    private $accessToken;

    /** @var string|null 
     * Tipo de Token.
     * Default: bearer
     */
    private $tokenType;

    /** @var integer|null 
     * Momento de expiração do Token
     * Default: T + 20 min
     */
    private $expiresIn;

    /**
     * @param $json
     *
     * @return Token
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new Token();
        $auth->populate($object);

        return $auth;
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
        $this->accessToken = isset($data->access_token) ? $data->access_token : null;
        $this->tokenType = isset($data->token_type) ? $data->token_type : null;
        $this->expiresIn = isset($data->expires_in) ? $data->expires_in : null;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param $accessToken
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param $tokenType
     *
     * @return $this
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param $expiresIn
     *
     * @return $this
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

}
