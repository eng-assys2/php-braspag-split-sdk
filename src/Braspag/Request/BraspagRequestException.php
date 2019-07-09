<?php

namespace Braspag\Request;

/**
 * Class BraspagRequestException
 *
 * @package Braspag\Request
 */
class BraspagRequestException extends \Exception
{

    private $braspagError;

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
    public function getBraspagError()
    {
        return $this->braspagError;
    }

    /**
     * @param BraspagError $braspagError
     *
     * @return $this
     */
    public function setBraspagError(BraspagError $braspagError)
    {
        $this->braspagError = $braspagError;

        return $this;
    }
}
