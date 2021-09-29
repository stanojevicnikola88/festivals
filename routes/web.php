<?php

use App\Http\Controllers\Admin\AdminEventController;
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


Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
Route::get('events/create', [AdminEventController::class, 'create'])->name('events.create');
Route::post('events', [AdminEventController::class, 'store'])->name('events.store');
Route::get('events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
Route::put('events', [AdminEventController::class, 'update'])->name('events.update');
Route::post('events/destroy', [AdminEventController::class, 'destroy'])->name('events.destroy');
