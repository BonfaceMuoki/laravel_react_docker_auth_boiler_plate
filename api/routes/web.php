<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'home']);
Route::get('/reset-password', [PasswordResetRequestController::class, 'resetPasswordForm']);
Route::group([
    'prefix' => 'mpesa-payments'
], function ($router) {
    Route::get('/generate-token', [PaymentController::class, 'generateToken']);
    Route::get('/initiate-stk-push', [PaymentController::class, 'intiateSTKpush']);
    Route::post('/stk-push-callback', [PaymentController::class, 'STKCallBack']);
    Route::get('/stk-query', [PaymentController::class, 'STKQuery']);
});

Route::group([
    'prefix' => 'payments'
], function ($router) {
    Route::get('/register-c2b', [PaymentController::class, 'registerC2B']);
    Route::get('/simulate', [PaymentController::class, 'Simulate']);
    Route::post('/ctob-confirmation', [PaymentController::class, 'registerC2BConfirmation']);
    Route::post('/ctob-validation', [PaymentController::class, 'registerC2BValidation']);
});