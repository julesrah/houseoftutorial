<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\instrumentController;
use App\Http\Controllers\instructorController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//INSTRUMENTS
Route::get('/instruments/all', [instrumentController::class, 'getInstrumentsAll'])->name('instrument.all');

//store instruments
Route::post('/instruments/store', [instrumentController::class, 'store'])->name('instrument.store');

//update instruments
Route::get('/instruments/{id}/edit', [instrumentController::class, 'edit'])->name('instrument.edit');
Route::post('/instruments/{id}', [instrumentController::class, 'update'])->name('instrument.update');

//delete instruments
Route::delete('instruments/{id}', [instrumentController::class, 'destroy'])->name('instrument.destroy');



//INSTRUCTORS
Route::get('/instructors/all', [instructorController::class, 'getInstructorsAll'])->name('instructor.all');

//store instructors
Route::post('/instructors/store', [instructorController::class, 'store'])->name('instructor.store');

//update instructors
Route::get('/instructors/{id}/edit', [instructorController::class, 'edit'])->name('instructor.edit');
Route::post('/instructors/{id}', [instructorController::class, 'update'])->name('instructor.update');

//delete instructors
Route::delete('instructors/{id}', [instructorController::class, 'destroy'])->name('instructor.destroy');




//SERVICES
Route::get('/services/all', [serviceController::class, 'getServicesAll'])->name('service.all');

//store services
Route::post('/services/store', [serviceController::class, 'store'])->name('service.store');

//update services
Route::get('/services/{id}/edit', [serviceController::class, 'edit'])->name('service.edit');
Route::post('/services/{id}', [serviceController::class, 'update'])->name('service.update');

//delete services
Route::delete('services/{id}', [serviceController::class, 'destroy'])->name('service.destroy');



//CLIENT
Route::get('/clients/all', [clientController::class, 'getClientsAll'])->name('client.all');

//store clients
Route::post('/clients/store', [clientController::class, 'store'])->name('client.store');

//update clients
Route::get('/clients/{id}/edit', [clientController::class, 'edit'])->name('client.edit');
Route::post('/clients/{id}', [clientController::class, 'update'])->name('client.update');

//delete clients
Route::delete('clients/{id}', [clientController::class, 'destroy'])->name('client.destroy');


Route::post('login', [UserController::class, 'userLogin']);

Route::group(['middleware' => 'auth:api'],function(){
    Route::get('profile_details', [UserController::class, 'userDetails']);
});
