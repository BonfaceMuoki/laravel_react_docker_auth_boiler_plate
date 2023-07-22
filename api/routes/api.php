<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'SendAccountPasswordResetLink']);
    Route::post('/reset-password', [AuthController::class, 'ResetPassword']);    
    Route::get('/all-users', [AuthController::class, 'allUsers']);
    Route::post('/register', [AuthController::class, 'register']); 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/user-information', [AuthController::class, 'userProfileDetails']);
    Route::get('/verify-reset-token', [AuthController::class, 'verifyResetToken']);     

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'commons'
], function ($router) {
    
    
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'
], function ($router) {
    Route::post('/add-role', [AdminController::class, 'addRoles']);
    Route::patch('/update-role/{id}', [AdminController::class, 'updateRole']);
    Route::delete('/delete-role/{id}', [AdminController::class, 'deleteRole']);
    Route::get('/get-all-roles', [AdminController::class, 'getAllRoles']);
    Route::get('/get-all-permissions', [AdminController::class, 'getAllPermissions']);
    Route::post('/add-permissions', [AdminController::class, 'addPermissions']);
    Route::post('/assign-role-permissions', [AdminController::class, 'assignRolePermissions']);
    Route::post('/send-accesor-invite', [AdminController::class, 'sendAccesorInvite']);
    Route::get('/get-dashboard', [AdminController::class, 'getDashboard']);   
});
Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);