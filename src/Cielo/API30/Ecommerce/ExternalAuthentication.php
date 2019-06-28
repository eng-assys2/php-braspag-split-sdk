<?php

namespace Cielo\API30\Ecommerce;

use Cielo\API30\Ecommerce\CieloSerializable;

/**
 * Class ExternalAuthentication
 *
 * @package Cielo\API30\Ecommerce
 */
class ExternalAuthentication implements CieloSerializable
{

    private $cavv;
    private $xid;
    private $eci;

    /**
     * ExternalAuthentication constructor.
     *
     */
    public function __construct($cavv = null,
                                $xid = null,
                                $eci=null)
    {
        $this->cavv = $cavv;
        $this->xid = $xid;
        $this->eci = $eci;
    }

    /**
     * @param $json
     *
     * @return ExternalAuthentication
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $externalAuthentication = new ExternalAuthentication();

        if (isset($object->ExternalAuthentication)) {
            $externalAuthentication->populate($object->ExternalAuthentication);
        }

        return $externalAuthentication;
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->cavv = isset($data->Cavv) ? $data->Cavv : null;
        $this->xid = isset($data->Xid) ? $data->Xid : null;
        $this->eci = isset($data->Eci) ? $data->Eci : null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getCavv()
    {
        return $this->cavv;
    }


    /**
     * @param $cavv
     *
     * @return $this
     */
    public function setCavv($cavv)
    {
        $this->cavv = $cavv;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getXid()
    {
        return $this->xid;
    }


    /**
     * @param $xid
     *
     * @return $this
     */
    public function setXid($xid)
    {
        $this->xid = $xid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEci()
    {
        return $this->eci;
    }


    /**
     * @param $eci
     *
     * @return $this
     */
    public function setEci($eci)
    {
        $this->eci = $eci;

        return $this;
    }


}
