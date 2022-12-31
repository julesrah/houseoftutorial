<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\damageController;
use App\Http\Controllers\instrumentController;
use App\Http\Controllers\serviceController;

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



//SERVICES
Route::get('/services/all', [serviceController::class, 'getServicesAll'])->name('service.all');

//store services
Route::post('/services/store', [serviceController::class, 'store'])->name('service.store');

//update services
Route::get('/services/{id}/edit', [serviceController::class, 'edit'])->name('service.edit');
Route::post('/services/{id}', [serviceController::class, 'update'])->name('service.update');

//delete services
Route::delete('services/{id}', [serviceController::class, 'destroy'])->name('service.destroy');




Route::get('/instructor/all',['uses' => 'instructorController@getInstructorsAll','as' => 'instructor.getInstructorsAll'] );
Route::resource('instructor', 'instructorController');

Route::get('/client/all',['uses' => 'clientController@getClientsAll','as' => 'client.getClientsAll'] );
Route::resource('client', 'clientController');

//DAMAGES
Route::get('/damages/all', [damageController::class, 'getDamagesAll'])->name('damage.all');

//store damages
Route::post('/damages/store', [damageController::class, 'store'])->name('damage.store');

//update damages
Route::get('/damages/{id}/edit', [damageController::class, 'edit'])->name('damage.edit');
Route::post('/damages/{id}', [damageController::class, 'update'])->name('damage.update');

//delete damages
Route::delete('damages/{id}', [damageController::class, 'destroy'])->name('damage.destroy');