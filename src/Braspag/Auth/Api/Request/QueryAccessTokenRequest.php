<?php

namespace Braspag\Auth\Api\Request;

use Braspag\Request\Request;

use Braspag\Auth\API\Auth;
use Braspag\Auth\API\Token;
use Braspag\Auth\API\Environment;

/**
 * Class QueryAccessTokenRequest
 *
 * @package Braspag\Auth\Api\Request
 */
class QueryAccessTokenRequest extends Request
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
     * @return Braspag\Auth\API\Token
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
            'User-Agent: CieloEcommerce/3.0 PHP SDK'
        ];

        $form_params = [
            'grant_type' => 'client_credentials'
        ];

        $response = $this->post($url, [], $headers, [], $auth_request, $form_params);
        
        return Token::fromJson($response['json']);
    }

}
