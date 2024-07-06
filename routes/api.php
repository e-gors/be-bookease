<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('show/user', [UserController::class, 'show']);
    Route::delete('delete/user', [UserController::class, 'destroy']);
});
