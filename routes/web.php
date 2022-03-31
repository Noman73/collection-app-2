<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\RittikiController;
use App\Http\Controllers\Admin\CollectorController;
use App\Http\Controllers\Admin\RittikiPayController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ScrollingController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\ExpenceAreaController;
use App\Http\Controllers\Admin\ExpenceController;
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


Route::get('/', [HomeController::class,'index']);
Auth::routes();
Route::group(['middleware'=>'isBaned'],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/load-data', [HomeController::class, 'loadData']);
    Route::resource('/collection', CollectionController::class);
    Route::resource('/donor', DonorController::class);
    Route::resource('/submission', SubmissionController::class);
    Route::get('/submission-view/{id}', [SubmissionController::class,'getData']);
    Route::post('/get-donor',[ DonorController::class,'getDonor']);
    Route::resource('/rittiki', RittikiController::class);
    Route::resource('/rittiki-pay', RittikiPayController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/expence_area',ExpenceAreaController::class);
    Route::resource('/expence',ExpenceController::class);
    Route::post('/get-role',[RoleController::class,'getRole']);
    Route::post('/get-rittiki',[RittikiController::class,'getRittiki']);
    Route::post('/get-collector',[SubmissionController::class,'getCollector']);
    Route::get('/collector-data',[CollectorController::class,'getData']);
    Route::get('/own-collection-data',[CollectorController::class,'getData']);
    Route::get('/scrolling-text',[ScrollingController::class,'showForm']);
    Route::post('/scrolling-text',[ScrollingController::class,'store'])->name('scrolling.store');
    Route::get('/password-reset',[PasswordResetController::class,'form']);
    Route::get('/reset-otp',[PasswordResetController::class,'otpForm']);
});