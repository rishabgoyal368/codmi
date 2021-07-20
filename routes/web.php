<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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
Route::match(['get', 'post'], '/signup', [AuthController::class, 'register'])->name('admin_register');


Route::group(['prefix' => 'admin', 'middleware' => array('isAdmin', 'checkPermission')], function () {
	Route::get('/dashboard', [DashboardController::class, 'dashboard']);
	Route::get('/logout', [AuthController::class, 'logout']);
	Route::match(['get', 'post'], '/my-profile', [DashboardController::class, 'profile']);

	Route::get('users', [UserController::class, 'list']);
	Route::get('retails', [UserController::class, 'retails']);
});
