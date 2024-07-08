<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\RiderController;

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
Route::post('/registerDriver', [AuthController::class, 'registerDriver']);
Route::post('/loginDriver', [AuthController::class, 'loginDriver']);
Route::post('/registerUser', [AuthController::class, 'registerUser']);
Route::post('/loginUser', [AuthController::class, 'loginUser']);
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
Route::group(['prefix' => 'auth'], static function () {
    Route::post('register', [RiderController::class, 'register']);
});
