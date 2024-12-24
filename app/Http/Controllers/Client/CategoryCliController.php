<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BookService;

class CategoryCliController extends Controller
{
    protected $bookService;

    public function __construct( BookService $bookService ){
        $this->bookService = $bookService;
    }

    public function saludar()
    {
        return "Hola Mundo";
    }

    public function findAllByBookUuid( $categoryUuid ){
        return $this->bookService->findAllByBookUuid( $categoryUuid );
    }

}
// 