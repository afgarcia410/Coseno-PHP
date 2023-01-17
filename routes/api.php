<?php

use App\Http\Controllers\ApiAuthController;
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

Route::post('login',[ApiAuthController::class, 'login']);
Route::get('logout',[ApiAuthController::class, 'logout']);
Route::post('register',[ApiAuthController::class, 'register']);
Route::get('protected',[ApiAuthController::class, 'protected']);
Route::get('cogeParam',[ApiAuthController::class, 'cogeParam']);
Route::get('admin',[ApiAuthController::class, 'admin']);
