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

Route::get('/maintenances/ticket', [MaintenanceController::class, 'ticket'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.ticket');

Route::get('/maintenances/ticket/{maintenance}', [MaintenanceController::class, 'editTicket'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.edit_ticket');

// Index
Route::get('/maintenances', [MaintenanceController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.index');

// Create
Route::get('/maintenances/create', [MaintenanceController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('maintenances.create');

// Store
Route::post('/maintenances', [MaintenanceController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.store');

// Show
Route::get('/maintenances/{maintenance}', [MaintenanceController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.show');

// Edit
Route::get('/maintenances/{maintenance}/edit', [MaintenanceController::class, 'edit'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('maintenances.edit');

// Update
Route::match(['put', 'patch'], '/maintenances/{maintenance}', [MaintenanceController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.update');

// Destroy
Route::delete('/maintenances/{maintenance}', [MaintenanceController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('maintenances.destroy');

Route::patch('/maintenances/{maintenance}/tasks/{task}', [MaintenanceController::class, 'updateTask'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.updateTask');

Route::patch('/maintenances/{maintenance}/status', [MaintenanceController::class, 'updateStatus'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.updateStatus');

Route::patch('/maintenances/{maintenance}/approval', [MaintenanceController::class, 'approval'])
    ->middleware(['auth', 'verified'])
    ->name('maintenances.approval');



/******************************************************** TASKS ********************************************************/

// Index
Route::get('/task-headers', [TaskHeaderController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.index');

// Create
Route::get('/task-headers/create', [TaskHeaderController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.create');

// Store
Route::post('/task-headers', [TaskHeaderController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.store');

// Show
Route::get('/task-headers/{task_header}', [TaskHeaderController::class, 'show'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.show');

// Edit
Route::get('/task-headers/{task_header}/edit', [TaskHeaderController::class, 'edit'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.edit');

// Update
Route::match(['put', 'patch'], '/task-headers/{task_header}', [TaskHeaderController::class, 'update'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.update');

// Destroy
Route::delete('/task-headers/{task_header}', [TaskHeaderController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'role:Admin,SuperAdmin'])
    ->name('task-headers.destroy');


