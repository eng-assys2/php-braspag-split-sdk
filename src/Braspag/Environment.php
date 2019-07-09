<?php

namespace Braspag;

/**
 * Interface Environment
 *
 * @package Braspag
 */
interface Environment
{
    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl();

}
