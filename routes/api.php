<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register'])->name('api.register');
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('api.login');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/products/search/{title}', [\App\Http\Controllers\API\ProductController::class,'search']);
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::apiResource('products', \App\Http\Controllers\API\ProductController::class)->middleware('auth:sanctum');
