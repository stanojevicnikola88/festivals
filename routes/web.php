<?php

use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventUserController;
use Illuminate\Support\Facades\Route;

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

// Authentication Routes
Auth::routes();

//Event routes
Route::get('/', [EventController::class, 'index'])->name('event.index');
Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');

//Subscribe to event route
Route::post('event/subscribe', [EventUserController::class, 'store'])->name('event.subscribe');

//Admin routes
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('events/{id}', [AdminEventController::class, 'show'])->name('events.show');
    Route::get('events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');
});

