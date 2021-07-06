<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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
Route::post('user-register', [AuthController::class, 'user_register']);

Route::post('user-login', [AuthController::class, 'userLogin']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('onboarding-question',[AuthController::class,'getOnboadingQuestion']);
    Route::post('submit-onboarding-question',[AuthController::class,'submitOnboadingQuestion']);
    
    Route::get('get-profile',[AuthController::class,'getProfile']);
    Route::post('update-profile',[AuthController::class,'updateProfile']);

});
