<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class Notification implements \JsonSerializable
{
    private $url;
    private $headers;

    /**
     * @param $json
     *
     * @return Notification
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $notification = new Notification();
        $notification->populate($object);

        return $notification;
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
        $this->url = isset($data->Url) ? $data->Url : null;
        
        $this->headers = [];
        if (isset($data->Headers)) {
            foreach ($data->Headers as $headers) {
                $header = new NotificationHeader();
                $header->populate($headers);    
                $this->headers[] = $header;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     *
     * @return NotificationHeader
     */
    public function header()
    {
        $header = new NotificationHeader();
        $this->headers[] = $header;

        return $header;
    }

    /**
     * @param $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

}
