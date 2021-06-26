<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\DashboardController;

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


Route::get('/', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/admin', [AuthController::class, 'login'])->name('admin_login');

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
	Route::get('/dashboard', [DashboardController::class, 'dashboard']);

	Route::get('/logout', [AuthController::class, 'logout']);

	// profile
	Route::match(['get', 'post'], '/my-profile', [DashboardController::class, 'profile']);
	Route::post('/change-password', [ProfileController::class, 'change_password']);

	
});