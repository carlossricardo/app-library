<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct( CategoryService $categoryService ){
        $this->categoryService = $categoryService;
    }


    public function create( Request $request ){        
        $newRequest = collect($request)->all();        
        return $this->categoryService->create( $newRequest );
    }

    public function findAll (){                      
        return $this->categoryService->findAll();
    }

}
