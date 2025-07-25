<?php

use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskHeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/******************************************************** MAINTENANCES ********************************************************/

Route::get('/maintenances/calendar/{year?}/{month?}', [MaintenanceController::class, 'calendar'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.calendar');

Route::resource('maintenances', MaintenanceController::class)->middleware(['auth', 'verified']);

Route::patch('/maintenances/{maintenance}/tasks/{task}', [MaintenanceController::class, 'updateTask'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.updateTask');

/******************************************************** TASKS ********************************************************/

Route::resource('task-headers', TaskHeaderController::class)->middleware(['auth', 'verified']);


