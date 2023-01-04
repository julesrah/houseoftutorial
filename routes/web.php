<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\instrumentController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\instructorController;

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

Route::GET('instrument', [instrumentController::class, 'index'])->name('instrument.index');
Route::GET('instructor', [instructorController::class, 'index'])->name('instructor.index');
Route::GET('client', [clientController::class, 'index'])->name('client.index');
Route::GET('service', [serviceController::class, 'index'])->name('service.index');
