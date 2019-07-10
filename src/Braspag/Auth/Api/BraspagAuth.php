<?php

namespace Braspag\Auth\API;

use Braspag\Auth\Api\Request\QueryAccessTokenRequest;

/**
 * The Braspag Auth SDK front-end;
 */
class BraspagAuth
{

    private $environment;

    /**
     * Create an instance of BraspagAuth choosing the environment where the
     * requests will be send
     *     
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
        
        $queryAccessTokenRequest = new QueryAccessTokenRequest($this->environment);

        return $queryAccessTokenRequest->execute($auth);
    }
}
