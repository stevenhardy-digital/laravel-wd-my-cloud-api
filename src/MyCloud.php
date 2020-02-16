<?php

namespace StevenHardyDigital\LaravelWdMyCloudApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MyCloud {
    const API_HOST = '';
    const AUTH_CONFIG_URL = 'https://config.mycloud.com';
    const AUTHORIZATION_ENDPOINT = 'https://wdc.auth0.com';

    protected $client;
    protected $client_key;
    protected $client_secret;
    protected $redirect_uri;

    public function __construct()
    {
        $this->client_key = config('mycloud.client_id');
        $this->client_secret = config('mycloud.client_secret');
        $this->redirect_uri = config('mycloud.redirect_uri');

    	$this->client = new Client([
            'base_uri' => self::API_HOST,
            'timeout'  => 2.0,
    	]);	
    }

    private function getConfigKey() 
    {
        try {
            $response = $this->client->get('config/v1/config');
            dd($response);
        } catch (ClientException $e) {
            $responseBody = $e->getResponse()->getBody(true);
        }

        return $responseBody;
    }
}