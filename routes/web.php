<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ScotterController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CanceledAccountController;

use App\Http\Controllers\Admin\PaymentController;

use App\Http\Controllers\Admin\PendingAccountController;
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
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('guest');
Route::group(['namespace' => 'Admin','middleware'=>'guest'], function () {
Route::resource('payments', 'PaymentController');
   Route::get('payments/pay/{code}/{id}', [PaymentController::class, 'pay'])->name('payments.pay');
   Route::get('/payments/{id}/thanks/', [PaymentController::class, 'thanks'])->name('thanks');
});
Route::group(['namespace' => 'Auth','middleware'=>'guest'], function () {

    Route::get('/login/{type}', [LoginController::class, 'log'])->name('login.show');
    Route::get('/login', [LoginController::class,'logs'])->name('logs');
    Route::post('/login', [LoginController::class,'login'])->name('login');
    Route::get('/logout/{type}', [LoginController::class,'logout'])->name('logout')->withoutMiddleware('guest');
});
Route::group(
    [
        'middleware' => [ 'auth:web']
    ], function () {
    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('dashboard');
    Route::get('/info/pdf', [HomeController::class, 'createPDF']);
    });
Route::group(['prefix'=>'dashboard','middleware' =>'auth:web'],function(){
      Route::group(['namespace'=>'Admin'],function(){

        Route::get('users/list', [ClientController::class, 'getUsers'])->name('Users.list');
        Route::get('users/edit/{id}', [ClientController::class, 'editClient']);
        Route::get('users/delete/{id}', [ClientController::class, 'delete']);
        Route::post('users/update/{id}', [ClientController::class, 'updateClient'])->name('Users.client.update');
        Route::resource('users', 'ClientController');

        Route::get('banners/list', [BannerController::class, 'getBanners'])->name('Banners.list');
        Route::get('banners/delete/{id}', [BannerController::class, 'delete']);
        Route::resource('banners', 'BannerController');
        Route::resource('scotters', 'ScotterController');
        Route::get('scotter', [ScotterController::class, 'getScotters'])->name('scotters.list');
        Route::get('scotters/edit/{id}', [ScotterController::class, 'edit'])->name('scotters.edit');
        Route::get('scotters/delete/{id}', [ScotterController::class, 'destroy'])->name('scotters.delete');
        Route::get('about-us',[SettingsController::class,'about_us'])->name('about_us');
        Route::post('about-us/store',[SettingsController::class,'about_us_store'])->name('about_us_store');
        Route::get('contact-us',[SettingsController::class,'contact_us_index'])->name('contact_us.index');
        Route::get('contact-us/create',[SettingsController::class,'contact_us_create'])->name('contact_us.create');
        Route::post('contact-us/store',[SettingsController::class,'contact_us_store'])->name('contact_us.store');
        Route::get('contact-us/update/{id}',[SettingsController::class,'contact_us_update'])->name('contact_us.update');
        Route::post('about-us/edit',[SettingsController::class,'about_us_edit'])->name('contact_us.edit');
        Route::get('/delete/{id}',[SettingsController::class,'destroy'])->name('settings.destroy');
        Route::post('/delete', [SettingsController::class, "bulkdelete"])->name('settings.delete');
        Route::get('qa',[SettingsController::class,'qa_index'])->name('qa.index');
        Route::get('qa/create',[SettingsController::class,'qa_create'])->name('qa.create');
        Route::post('qa/store',[SettingsController::class,'qa_store'])->name('qa.store');
        Route::get('qa/update/{id}',[SettingsController::class,'qa_update'])->name('qa.update');
        Route::post('qa/edit',[SettingsController::class,'qa_edit'])->name('qa.edit');
        Route::post('contact-us/edit/{id}',[SettingsController::class,'ContactUs_edit'])->name('contactus.edit');
        Route::get('contact-us/list', [SettingsController::class, 'getContact'])->name('contact.list');
        Route::get('qa/list', [SettingsController::class, 'getQa'])->name('qa.list');
        Route::get('finished/list', [TripController::class, 'getFinished'])->name('finished.list');
        Route::get('finished/index', [TripController::class, 'finished_index'])->name('finished.index');
//        Route::get('/finished/finished_trips/index/{id}', [TripController::class, 'finished_trips_index'])->name('finished_trips.index');


        Route::get('inTrip/list', [TripController::class, 'getInTrip'])->name('inTrip.list');
        Route::get('inTrip/index', [TripController::class, 'inTrip_index'])->name('inTrip.index');
//        Route::get('/inTrip/inTrip_trips/index/{id}', [TripController::class, 'inTrip_trips_index'])->name('inTrip_trips.index');

        Route::get('notifications', [NotificationController::class, 'index'])->name('notification.index');
        Route::get('notifications/header', [NotificationController::class, 'getAll'])->name('get.all');
        Route::get('notifications/read/{id}', [NotificationController::class, 'make_read'])->name('make.read');
  Route::get('admins/list', [AdminController::class, 'getAdmins'])->name('Admins.list');
        Route::resource('admins', 'AdminController');
        Route::get('admins/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::get('admins/remove/{id}', [AdminController::class, 'delete'])->name('remove');




      /*  Route::get('accounts/list', [AccountController::class, 'getAccounts'])->name('Accounts.list');
        Route::resource('accounts', 'AccountController');
        Route::get('accounts/showdetails/{id}', [AccountController::class, 'showdetails'])->name('accountsshowdetails');
        Route::get('accounts/delete/{id}', [AccountController::class, 'block'])->name('block');

        Route::get('accounts/createacc/{id}', [AccountController::class, 'createacc'])->name('createacc');

        Route::get('canceled/list', [CanceledAccountController::class, 'getCanceledAccounts'])->name('Canceled.list');
        Route::resource('canceledaccounts', 'CanceledAccountController');
        Route::get('accountscanceled/showdetails/{id}', [CanceledAccountController::class, 'showdetails'])->name('canceledshowdetails');
        Route::get('accounts/approve/{id}', [CanceledAccountController::class, 'approve'])->name('approve');


        Route::get('pending/list', [PendingAccountController::class, 'getPendingAccounts'])->name('Pending.list');
        Route::resource('pendingaccounts', 'PendingAccountController');
        Route::get('accountspending/showdetails/{id}', [PendingAccountController::class, 'showdetails'])->name('pendingshowdetails');
        Route::get('accountspending/approving/{id}', [PendingAccountController::class, 'approve'])->name('approving');
        Route::get('accountspending/canceled/{id}', [PendingAccountController::class, 'cancel'])->name('canceled');
        Route::get('/deletefile/{id}', [AccountController::class, 'deletefile'])->name('deletefile');
        */
    Route::get('payment/list', [TripController::class, 'successpay'])->name('success.pay');
       Route::get('payment/pay/success', [TripController::class, 'all'])->name('payment.all');
       
          Route::get('trips/nonpaid/list', [TripController::class, 'nonpaidtrips'])->name('nonpaid.trips');
       Route::get('paid/non/', [TripController::class, 'nonpaidall'])->name('paid.non');
       
       
    });

});
});
