<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthenticationService;

class AuthenticationController extends Controller
{

    protected $authService;

    public function __construct( AuthenticationService $authService ){
        $this->authService = $authService;
    }


    public function login( Request $request ){        
        $data_user = collect($request)->all();        
        return $this->authService->login( $data_user['email'], $data_user['password'] );
    }

    public function register( Request $request ){        
        // $data_user = collect($request)->all();        
        return $this->authService->register( $request );
    }




}
