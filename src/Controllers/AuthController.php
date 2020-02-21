<?php

namespace StevenHardyDigital\LaravelWdMyCloudApi\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Config\Repository;
use StevenHardyDigital\LaravelWdMyCloudApi\MyCloud;
use StevenHardyDigital\LaravelWdMyCloudApi\Controllers\Controller;

class AuthController extends Controller {

    protected $config;

    public function __construct(Repository $config) {
        $this->config = $config;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('mycloud')
                ->with([
                    'connection' => 'Username-Password-Authentication',
                    'sso' => false,
                    'audience'=> 'mycloud.com',
                    'protocol' => 'oauth2',
                    'client_id'=> $this->config->get('mycloud.client_id')
                ])
                ->redirect();
    }
    
    public function handleProviderCallback()
    {
        $user = Socialite::with('mycloud')->user();
    
        // $user->token;
    }
    
    
}