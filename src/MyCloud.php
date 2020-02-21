<?php

namespace StevenHardyDigital\LaravelWdMyCloudApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MyCloud
{
    const API_HOST = '';
    const AUTH_CONFIG_URL = 'https://config.mycloud.com';
    const AUTHORIZATION_ENDPOINT = 'https://wdc.auth0.com';

    protected $client;
    protected $client_key;
    protected $client_secret;
    protected $redirect_uri;

    public function __construct()
    {
        $this->client_id = config('mycloud.client_id');
        $this->client_secret = config('mycloud.client_secret');
        $this->redirect_uri = config('mycloud.redirect_uri');

        $this->client = new Client([
            'base_uri' => self::API_HOST,
            'timeout'  => 2.0,
        ]);
    }
}

/**
 * TODO:: Make a url request to:
 * https://<service.auth0.url>/authorize?
* scope=openid%20offline_access%20nas_read_write%20nas_read_only%20user_read%20device_read
* &response_type=code&connection=Username-Password-Authentication&sso=false
* &audience=mycloud.com&state=my-custom-state&protocol=oauth2
* &client_id=<client_id>&redirect_uri=http%3A%2F%2Flocalhost
*
 * TODO:: Make a function for getting the code and state of the URL
 * TODO:: Make an API request to get auth code
 */