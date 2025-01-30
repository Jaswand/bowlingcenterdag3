<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/reserveringoverzicht', function () {
    $reservering = App\Models\Reservering::all(); // Assuming you have a Reservering model
    return view('reserveringoverzicht.index', compact('reservering'));
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/reserveren', [App\Http\Controllers\ReserveringController::class, 'index'])->name('reserveren');
Route::get('/reserveren/edit/{reservering}', [App\Http\Controllers\ReserveringController::class, 'edit'])->name('reservering.edit');
Route::put('/reserveren/{reservering}', [App\Http\Controllers\ReserveringController::class, 'update'])->name('reservering.update');

Route::get('reserverenoverzicht', [App\Http\Controllers\ReserveringController::class, 'index'])->name('reserverenoverzicht');
