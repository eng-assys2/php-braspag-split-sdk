<?php

namespace BraspagSplit\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package BraspagSplit\Onboarding\API
 */
class NotificationHeader implements \JsonSerializable
{
    
    private $key;

    private $value;

    /**
     * @param $json
     *
     * @return NotificationHeader
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $auth = new NotificationHeader();
        $auth->populate($object);

        return $auth;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->key = isset($data->Key) ? $data->Key : null;
        $this->value = isset($data->Value) ? $data->Value : null;
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

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

}
