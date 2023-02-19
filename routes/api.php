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
Route::prefix('user')->controller(App\Http\Controllers\Api\Auth\UserAuthController::class)->middleware('checkLang')->group(function () {
    Route::post('login', [App\Http\Controllers\Api\Auth\UserAuthController::class,'login'])->middleware("throttle:1:1");
    Route::post('register', [App\Http\Controllers\Api\Auth\UserAuthController::class,'register']);
    Route::post('logout',[App\Http\Controllers\Api\Auth\UserAuthController::class, 'logout']);


    Route::post('me', [App\Http\Controllers\Api\Auth\UserAuthController::class,'me']);
    Route::post('refresh', [App\Http\Controllers\Api\Auth\UserAuthController::class,'refresh']);
    Route::post('/profile/change-password',[App\Http\Controllers\Api\Auth\UserAuthController::class,'change_password']);
    Route::get('user/getUserData',[AuthController::class,'getUserData']);
    Route::post('/profile/update-profile',[App\Http\Controllers\Api\Auth\UserAuthController::class,'update_profile']);

    Route::post('password/email',  [App\Http\Controllers\Api\Auth\UserAuthController::class,'forget']);
    Route::post('password/code/check', [App\Http\Controllers\Api\Auth\UserAuthController::class,'code']);

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/has_account',[App\Http\Controllers\Api\Account\AccountController::class,'has_account']);
    Route::post('/make-account',[App\Http\Controllers\Api\Account\AccountController::class,'make_account']);
    Route::post('/make-transaction',[App\Http\Controllers\Api\Account\AccountController::class,'make_transaction']);

    Route::get('/scotters',[App\Http\Controllers\Api\Trip\ScotterController::class,'index']);

    Route::get('settings/about-us',[App\Http\Controllers\Api\Contact\ContactusController::class,'about_us']);
    Route::get('settings/contact-us',[App\Http\Controllers\Api\Contact\ContactusController::class,'contact_us']);
    Route::get('settings/faq',[App\Http\Controllers\Api\Contact\ContactusController::class,'faq']);

    Route::get('banners',[App\Http\Controllers\Api\Contact\ContactusController::class,'banner']);

    Route::post('trip/create',[App\Http\Controllers\Api\Trip\ScotterController::class,'starttrip']);
    Route::post('trip/end',[App\Http\Controllers\Api\Trip\ScotterController::class,'endtrip']);
    Route::get('trip/index',[App\Http\Controllers\Api\Trip\ScotterController::class,'getalltrips']);


        Route::post('/paynow',[App\Http\Controllers\Api\Trip\ScotterController::class,'paynow']);

      Route::get('previous/trips',[App\Http\Controllers\Api\Trip\ScotterController::class,'getallNonPaytrips']);

});
