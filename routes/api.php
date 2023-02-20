<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\changePasswordController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

*/

Route::post('/register',[registerController::class, 'register']);
Route::post('/login',[loginController::class, 'login']);
Route::post('/changePassword/user',[changePasswordController::class, 'changePassword']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout',[loginController::class, 'logout']);
});
Route::post('/user/delete',[registerController::class, 'delete_user'])->middleware(['auth:sanctum']);
Route::post('/user/update',[registerController::class, 'update_user'])->middleware(['auth:sanctum']);

Route::post('/buytoken/visa',[PaymentsController::class, 'makePayment']);
Route::post('/get/sites',[loginController::class, 'sites']);
Route::post('/get/data/app',[loginController::class, 'get_data']);


Route::post('/verify', 'registerController@verify')->name('verify');

Route::post('forgotpassword',[ForgotPasswordController::class, 'forgot_pass']);

