<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Client\AuthenticationCliController;
use App\Http\Controllers\Admin\{SecurityController, LoanController, DashboardController};
use App\Http\Controllers\Client\CategoryCliController;
use App\Http\Controllers\Client\BookCliController;
use App\Http\Controllers\Tools\ToolController;
use App\Http\Controllers\Client\{LoanCliController, CartCliController};
use App\Http\Middleware\JwtMiddleware;


//Authentication
Route::prefix('authentication')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
    
    //Client
    Route::post('/client/register', [AuthenticationCliController::class, 'registerClient']);
});

//Dashboard
Route::prefix('dashboard')->middleware('jwt-middleware')->group(function () {

    Route::get('/active', [DashboardController::class, 'findAll'])
        ->middleware('profile-middleware:ADMIN');
    Route::get('/client/active', [DashboardController::class, 'findAllClient'])
        ->middleware('profile-middleware:STUDENT,ADMIN');


});



//Administration
Route::prefix('administration')->middleware('jwt-middleware')->group(function () {

    //Categories
    Route::post('/category', [CategoryController::class, 'create'])
        ->middleware('profile-middleware:ADMIN');
    Route::get('/category', [CategoryController::class, 'findAll'])
        ->middleware('profile-middleware:ADMIN');
    Route::patch('/category', [CategoryController::class, 'patch'])
        ->middleware('profile-middleware:ADMIN');
    Route::get('/category/remove', [CategoryController::class, 'deleteItem'])
        ->middleware('profile-middleware:ADMIN');


        
    Route::get('/client/category', [CategoryCliController::class, 'findAllClient'])
        ->middleware('profile-middleware:ADMIN');


    //Books
    Route::post('/book', [BookController::class, 'create'])
        ->middleware('profile-middleware:ADMIN');
    Route::patch('/book', [BookController::class, 'patch'])
        ->middleware('profile-middleware:ADMIN');
    Route::get('/book', [BookController::class, 'findAll'])
        ->middleware('profile-middleware:ADMIN');
    Route::get('/book/remove', [BookController::class, 'deleteItem'])
        ->middleware('profile-middleware:ADMIN');

    //Books clients
    Route::get('/client/book/{categoryUuid}/{offset}/{limit}', [BookCliController::class, 'findAllByBookUuid'])
        ->middleware('profile-middleware:ADMIN,STUDENT');

    Route::get('/client/book', [BookCliController::class, 'findAllClient'])
    ->middleware('profile-middleware:STUDENT,ADMIN');  

    //Cart
    Route::get('/client/cart/books', [CartCliController::class, 'findAllCart'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  
    Route::get('/client/cart/book/add', [CartCliController::class, 'addBooksToCart'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  
    Route::get('/client/cart/book/reduce', [CartCliController::class, 'reduceBooksToCart'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  
    Route::get('/client/cart/book/remove', [CartCliController::class, 'deleteItemCartBook'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  
    Route::get('/client/cart/book/removeAll', [CartCliController::class, 'deleteAllCart'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  
    Route::post('/client/cart/book', [CartCliController::class, 'createLoanCart'])
        ->middleware('profile-middleware:STUDENT,ADMIN');  


    //Loans
    Route::get('/loan', [LoanController::class, 'findAll'])
        ->middleware('profile-middleware:ADMIN');
    Route::patch('/loan', [LoanController::class, 'patch'])
        ->middleware('profile-middleware:ADMIN');    
    Route::get('/loan/remove', [LoanController::class, 'deleteItem'])
        ->middleware('profile-middleware:ADMIN');

    Route::get('/client/loan', [LoanCliController::class, 'findAllClient'])
        ->middleware('profile-middleware:STUDENT');  



});




//Security
Route::prefix('security')->middleware('jwt-middleware')->group(function () {

    Route::post('/profile', [SecurityController::class, 'createProfile'])
        ->middleware('profile-middleware:ADMIN');

    Route::get('/user', [SecurityController::class, 'findUserActive'])
        ->middleware('profile-middleware:STUDENT,ADMIN');


    Route::post('/privilege', [SecurityController::class, 'createPrivilege'])
        ->middleware('profile-middleware:ADMIN');

});

//Permission
Route::prefix('permission')->middleware('jwt-middleware')->group(function () {


    Route::get('/option', [SecurityController::class, 'findAllPermissions'])
        ->middleware('profile-middleware:STUDENT,ADMIN');          
});



Route::post('upload', [ToolController::class, 'upload']);

Route::get('files/getFile/{folder}/{file}', [ToolController::class, 'getFile']);


