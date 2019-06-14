<?php

namespace Cielo\API30;

/**
 * Interface Environment
 *
 * @package Cielo\API30
 */
interface Environment
{
    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl();

    /**
     * Gets the environment's Api Query URL
     *
     * @return string the Api Query URL
     */
    public function getApiQueryURL();

    /**
     * Gets the environment's Braspag Auth URL
     *
     * @return string Braspag Auth URL
     */
    public function getbraspagAuthURL();

    /**
     * Gets the environment's Api Braspag Split URL
     *
     * @return string Api Braspag Split URL
     */
    public function getapiBraspagSplitURL();
}
