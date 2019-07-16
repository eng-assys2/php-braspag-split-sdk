<?php

namespace BraspagSplit\Auth\Api\Request;

use BraspagSplit\Request\AbstractRequest;

use BraspagSplit\Auth\API\Auth;
use BraspagSplit\Auth\API\Token;
use BraspagSplit\Auth\API\Environment;

/**
 * Class QueryAccessTokenRequest
 *
 * @package BraspagSplit\Auth\Api\Request
 */
class QueryAccessTokenRequest extends AbstractRequest
{

    private $environment;

    /**
     * QueryAccessTokenRequest constructor.
     *
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param $paymentId
     *
     * @return BraspagSplit\Auth\API\Token
     * @throws \GuzzleHttp\Exception\ConnectException
     */
    public function execute($auth)
    {
        $url = $this->environment->getApiUrl() . 'oauth2/token';

        $auth_request = [
            $auth->getId(),
            $auth->getKey()
        ];

        $headers = [
            'Accept: application/json',
            'User-Agent: Gerenciagram Braspag API PHP SDK',
        ];

        $form_params = [
            'grant_type' => 'client_credentials'
        ];

        return $this->post($url, [], $headers, [], $auth_request, $form_params);
        
    }

    /**
     * @param $json
     *
     * @return Token
     */
    protected function unserialize($json)
    {
        return Token::fromJson($json);
    }

}
