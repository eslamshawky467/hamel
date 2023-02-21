<?php

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
Route::prefix('provider')->controller(App\Http\Controllers\Api\Auth\ProviderAuthController::class)->middleware('checkLang')->group(function () {
    Route::post('providers/login', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'login'])->middleware("throttle:global");
    Route::post('providers/register', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'register']);
    Route::post('providers/logout',[App\Http\Controllers\Api\Auth\ProviderAuthController::class, 'logout']);
    Route::post('providers/checkcode', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'checkcode'])->middleware("throttle:global");

    Route::post('me', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'me']);
    Route::post('refresh', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'refresh']);
    Route::post('providers/profile/change-password',[App\Http\Controllers\Api\Auth\ProviderAuthController::class,'change_password']);
    Route::post('providers/profile/update-profile',[App\Http\Controllers\Api\Auth\ProviderAuthController::class,'update_profile']);

    Route::post('providers/password/email',  [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'forget'])->middleware("throttle:forget");
    Route::post('providers/password/code/check', [App\Http\Controllers\Api\Auth\ProviderAuthController::class,'code'])->middleware("throttle:forget");

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
