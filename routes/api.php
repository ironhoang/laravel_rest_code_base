<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# All Authentication Routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
	Route::post('/login', [AuthController::class, 'login']);
	route::post('/register', [AuthController::class, 'storeUser']);
});

# All services api routes
Route::group(['middleware' => ['ip-whitelist', 'api', 'jwt-verify'], 'prefix' => 'v1'], function ($router) {
	$router->group(['middleware' => 'App\Http\Middleware\RoleMiddleware:admin'], function () use ($router) {
		Route::apiResource('roles', RoleController::class);
		Route::apiResource('/posts', PostController::class);
		Route::apiResource('/categories', CategoryController::class);
	});
	
	Route::get('/profile', [UserController::class, 'getProfile']);
	Route::put('/profile', [UserController::class, 'updateProfile']);
	
});

Route::group(['middleware' => ['ip-whitelist', 'api'], 'prefix' => 'v1'], function ($router) {
	
	
	Route::get('/public_posts', [PublicPostController::class, 'index']);
	
});