<?php

namespace Braspag\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package Braspag\Onboarding\API
 */
class Attachment implements \JsonSerializable
{
    private $attachmentType;

    private $file;

    /**
     * @param $json
     *
     * @return Attachment
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $attachment = new Attachment();
        $attachment->populate($object);

        return $attachment;
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
        $this->attachmentType = isset($data->AttachmentType) ? $data->AttachmentType : null;

        $this->file = isset($data->File) ? (new AttachmentFile())->populate($data->File) : null;
    }

    /**
     * @return mixed
     */
    public function getAttachmentType()
    {
        return $this->attachmentType;
    }

    /**
     * @param $attachmentType
     *
     * @return $this
     */
    public function setAttachmentType($attachmentType)
    {
        $this->attachmentType = $attachmentType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

}
