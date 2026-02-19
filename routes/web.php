<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TimeEntryController;
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

    Route::get('/projects/{project}/tasks', [ProjectController::class, 'tasksForProject']);


    Route::post('/projects/{project}/tasks', [ProjectController::class, 'storeTasks'])
    ->name('tasks.store');

   Route::resource('invoices', InvoiceController::class);
   Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])
    ->name('invoices.download');

    Route::resource('expenses', ExpenseController::class)
    ->only(['index', 'create', 'store', 'show', 'destroy']);

    Route::resource('time-entries', TimeEntryController::class);






});

require __DIR__.'/auth.php';
