<?php

namespace StevenHardyDigital\LaravelWdMyCloudApi\Http\Controllers;

use StevenHardyDigital\LaravelWdMyCloudApi\Http\Controllers\Controller;
use StevenHardyDigital\LaravelWdMyCloudApi\MyCloud;

class AuthController extends Controller {

    public function auth(MyCloud $mycloud) {
        // $mycloud->getConfigKey();
        return view('mycloud::test');
    }
    
}