<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*************************************
 *          Public routes            *
 *                                   *
 *************************************/

//login page
Route::post('/login',                     [AuthController::class,  'login']);
Route::post('registerClient/{company_id}',[AuthController::class,  'registerClient']);




/*************************************
 *      Protected routes Auth        *
 *                                   *
 *************************************/
Route::group(['middleware' => ['auth:sanctum']], function () {

    //logOut
    Route::post('logout',         [AuthController::class, 'logout']);

    // product
    Route::get('listProducts',    [ProductController::class, 'listProducts']);
    Route::get('showProduct/{id}',[ProductController::class, 'showProduct']);
    Route::post('storeProduct',   [ProductController::class, 'storeProduct']);

    // order
    Route::get('listOrders',    [OrderController::class, 'listOrders']);
    Route::get('showOrder/{id}',[OrderController::class, 'showOrder']);
    Route::post('storeOrder',   [OrderController::class, 'storeOrder']);


    Route::get('bestSelling',[ProductController::class, 'bestSelling']);

});
