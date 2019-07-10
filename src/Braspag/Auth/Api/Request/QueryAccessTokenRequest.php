<?php

namespace Braspag\Auth\Api\Request;

use Braspag\Request\AbstractRequest;

use Braspag\Auth\API\Auth;
use Braspag\Auth\API\Token;
use Braspag\Auth\API\Environment;

/**
 * Class QueryAccessTokenRequest
 *
 * @package Braspag\Auth\Api\Request
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
