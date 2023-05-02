<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeliveryDataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect('/login');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    //CLIENT
    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('dashboard.clients.index');
    Route::get('/dashboard/clients/add', [ClientController::class, 'create'])->name('dashboard.clients.create');
    Route::get('/dashboard/clients/{client}', [ClientController::class, 'show'])->name('dashboard.clients.show');
    Route::post('/dashboard/clients', [ClientController::class, 'store'])->name('dashboard.clients.store');
    Route::get('/dashboard/clients/{client}/edit', [ClientController::class, 'edit'])->name('dashboard.clients.edit');
    Route::put('/dashboard/clients/{client}', [ClientController::class, 'update'])->name('dashboard.clients.update');
    Route::delete('/dashboard/clients/{client}', [ClientController::class, 'destroy'])->name('dashboard.clients.destroy');
    //DELIVERY DATA
    Route::get('/dashboard/clients/{client}/delivery_data/add', [DeliveryDataController::class, 'create'])->name('dashboard.clients.delivery_data.create');
    Route::post('/dashboard/clients/{client}/delivery_data', [DeliveryDataController::class, 'store'])->name('dashboard.clients.delivery_data.store');
    Route::get('/dashboard/clients/{client}/delivery_data/{deliveryData}/edit', [DeliveryDataController::class, 'edit'])->name('dashboard.clients.delivery_data.edit');
    Route::put('/dashboard/clients/{client}/delivery_data/{deliveryData}', [DeliveryDataController::class, 'update'])->name('dashboard.clients.delivery_data.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
