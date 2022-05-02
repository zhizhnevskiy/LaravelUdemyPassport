<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UserController;
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
// Standard Route
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Login Route
Route::post('/login', [AuthController::class, 'Login']);

// Register Route
Route::post('/register', [AuthController::class, 'Register']);

// Forget Password Route
Route::post('/forgotPassword', [ForgotController::class, 'ForgotPassword']);

// Reset Password Route
Route::post('/resetPassword', [ResetController::class, 'ResetPassword']);

// Current user Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');
