<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emailcontroller;  
use App\Http\Controllers\RideController;  
use App\Http\Controllers\ReservationController;  
use App\Http\Controllers\Controller;  


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/send_welcom', [emailController::class, 'SendWelcomEmail']);

Route::get('/ridesCatalogue', [RideController::class, 'getRides'])->name('ridesCatalogue');

Route::post('/rideReservation/{id}', [ReservationController::class, 'create'])->name('rideReservation');

// Route POST pour soumettre les données
// Route::post('/rideReservation', [ReservationController::class, 'store'])->name('rideReservation.store');





