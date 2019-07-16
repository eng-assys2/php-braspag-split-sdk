<?php

namespace BraspagSplit\Onboarding\API;

/**
 * Class Onboarding
 *
 * @package BraspagSplit\Onboarding\API
 */
class AttachmentFile implements \JsonSerializable
{
    private $name;

    private $fileType;

    private $data;

    /**
     * @param $json
     *
     * @return AttachmentFile
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);

        $attachmentFile = new AttachmentFile();
        $attachmentFile->populate($object);

        return $attachmentFile;
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
        $this->name = isset($data->Name) ? $data->Name : null;
        $this->fileType = isset($data->FileType) ? $data->FileType : null;
        $this->data = isset($data->Data) ? $data->Data : null;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param $fileType
     *
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

}
