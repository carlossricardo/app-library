<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthenticationService;

class AuthenticationCliController extends Controller
{
    protected $authService;

    public function __construct( AuthenticationService $authService ){
        $this->authService = $authService;
    }

    public function registerClient( Request $request ){                
        return $this->authService->registerClient( $request );
    }
}
