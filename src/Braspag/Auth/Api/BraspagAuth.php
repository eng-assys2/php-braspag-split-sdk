<?php

namespace Braspag\Auth\API;

use Braspag\Merchant;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;

/**
 * The Braspag Auth SDK front-end;
 */
class BraspagAuth
{

    private $merchant;

    private $environment;

    /**
     * Create an instance of BraspagAuth choosing the environment where the
     * requests will be send
     *
     * @param $id
     *      The MerchantId
     * @param $key
     *      The MerchantKey
     * @param Environment environment
     *            The environment: {@link Environment::production()} or
     *            {@link Environment::sandbox()}
     */
    public function __construct(Environment $environment = null)
    {
        if ($environment == null) {
            $environment = Environment::sandbox();
        }

        $this->environment = $environment;
    }

    /**
     * Creates an access token in Braspag to operates with Splitted Payments.
     *
     * @param Auth $auth
     * 
     * @return Token The access Token returned by Braspag.
     *
     * @throws ConnectException if anything gets wrong.
     *
     */
    public function createAuthToken($auth)
    {
        $url = $this->environment->getApiUrl() . 'oauth2/token';
        $guzzleClient = new GuzzleClient();

        try {
            $response = $guzzleClient->post($url,
                [
                    'http_errors' => false,
                    'auth' => [
                        $auth->getId(),
                        $auth->getKey()
                    ],
                    'headers' => [
                        'Accept: application/json',
                        'User-Agent: CieloEcommerce/3.0 PHP SDK'
                    ],
                    'form_params' => [
                        'grant_type' => 'client_credentials'
                    ]
                ]
            );

            return Token::fromJson($response->getBody()->getContents());

        } catch (ConnectException $ex) {
            return null;
        }

    }
}
