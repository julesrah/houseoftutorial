<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\damageController;
use App\Http\Controllers\instrumentController;
use App\Http\Controllers\serviceController;

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

Route::resource('instructor', 'instructorController');
Route::get('/instructor-index','instructorController@getInstructorsAll');

Route::resource('client', 'clientController');
Route::get('/client-index','clientController@getClientsAll');


Route::GET('instrument', [instrumentController::class, 'index'])->name('instrument.index');
Route::GET('damage', [damageController::class, 'index'])->name('damage.index');
Route::GET('service', [serviceController::class, 'index'])->name('service.index');
