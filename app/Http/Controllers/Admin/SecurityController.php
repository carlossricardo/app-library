<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Services\PrivilegeService;
use App\Services\SecurityService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;


class SecurityController extends Controller
{

    protected $profileService;
    protected $privilegeService;
    protected $securityService;

    public function __construct( SecurityService $securityService, ProfileService $profileService, PrivilegeService $privilegeService  ){
        $this->profileService = $profileService;
        $this->privilegeService = $privilegeService;
        $this->securityService = $securityService;
    }

    public function createProfile( Request $request ){        
        // $newRequest = collect($request)->all();        
        return $this->profileService->create( $request );
    }
    
    public function createPrivilege( Request $request ){        
        // $newRequest = collect($request)->all();        
        return $this->privilegeService->create( $request );
    }

    public function findAllPermissions( Request $request ){                     
        return $this->securityService->findAllPermissions( $request );
    }

   

}
