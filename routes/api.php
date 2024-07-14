<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;

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

Route::post('register', [UserController::class, 'store']);
Route::post('login', [Controller::class, 'login']);

Route::group([
    // 'middleware' => 'auth:api',
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\API\V1'
], function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('services', 'ServiceController');
});

// Route::middleware('auth:api')->group(function () {
//     Route::get('users', [UserController::class, 'index']);
//     Route::get('services', [ServiceController::class, 'index']);
//     Route::get('show/user', [UserController::class, 'show']);
//     Route::delete('delete/user', [UserController::class, 'destroy']);
// });
