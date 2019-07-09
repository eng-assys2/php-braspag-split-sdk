<?php

namespace Braspag\Auth\API;

/**
 * Class Auth
 *
 * @package Braspag\Auth\API
 */
class Auth implements \JsonSerializable
{
    /** @var string|null 
     * Merchant ID da Braspag
     */
    private $id;

    /** @var string|null 
     * Merchant Key da Braspag
     * Default: bearer
     */
    private $key;

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
     * @return Auth
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new Auth();
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
     * Auth constructor.
     *
     * @param $id
     * @param $key
     */
    public function __construct($id, $key)
    {
        $this->id  = $id;
        $this->key  = $key;
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->id = isset($data->id) ? $data->id : null;
        $this->key = isset($data->key) ? $data->key : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

}
