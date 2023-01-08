<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\instrumentController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\instructorController;
use App\Http\Controllers\recordController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\API\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::GET('record', [recordController::class, 'index'])->name('record.index');

Route::get('/login', function(){
    return view('welcome');
})->name('login');
Route::GET('/service-index','serviceController@getService');
route::view('/shop','shop.index');

//CLIENT REGISTER   
Route::post('clientRegister', [UserController::class, 'clientRegister'])->name('client.register');

//ADMIN REGISTER   
Route::post('adminRegister', [UserController::class, 'adminRegister'])->name('admin.register');

//LOGIN USERS   
Route::post('login', [UserController::class, 'login'])->name('login');

// Route::group(['middleware' => 'auth:api'],function(){
    Route::GET('instrument', [instrumentController::class, 'index'])->name('instrument.index');
    Route::GET('instructor', [instructorController::class, 'index'])->name('instructor.index');
    Route::GET('client', [clientController::class, 'index'])->name('client.index');
    Route::GET('service', [serviceController::class, 'index'])->name('service.index');
// });

Route::view('/dashboard','Dashboard.index');
Route::get('/saleschart', [DashboardController::class, 'salesChart'])->name('saleschart');


route::view('/chart', 'chart.index');
Route::get('/saleschart',[
    'uses' => 'App\Http\Controllers\DashboardController@salesChart',
]);


Route::GET('/serviceChart', [DashboardController::class, 'serviceChart']);

Route::GET('/instrumentChart', [DashboardController::class, 'instrumentChart']);

Route::GET('/instructorChart', [DashboardController::class, 'instructorChart']);

// Route::GET('/brand-chart', [ChartController::class, 'productChart']);

// Route::GET('/town-chart', [ChartController::class, 'townChart']);
Route::GET('/conditionChart', [DashboardController::class, 'conditionChart']);