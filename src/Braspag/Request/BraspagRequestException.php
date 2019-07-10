<?php

namespace Braspag\Request;

/**
 * Class BraspagRequestException
 *
 * @package Braspag\Request
 */
class BraspagRequestException extends \Exception
{

    private $cieloError;

    /**
     * BraspagRequestException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $previous
     */
    public function __construct($message, $code, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getCieloError()
    {
        return $this->cieloError;
    }

    /**
     * @param CieloError $cieloError
     *
     * @return $this
     */
    public function setCieloError(CieloError $cieloError)
    {
        $this->cieloError = $cieloError;

        return $this;
    }
}
