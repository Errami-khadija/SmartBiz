<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::resource('clients', ClientController::class);

    Route::resource('projects', ProjectController::class);

Route::patch('/tasks/{task}/toggle', [ProjectController::class, 'toggle'])
    ->name('tasks.toggle');

    Route::post('/projects/{project}/tasks', [ProjectController::class, 'storeTasks'])
    ->name('tasks.store');



});

require __DIR__.'/auth.php';
