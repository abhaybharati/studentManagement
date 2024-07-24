<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
Route::middleware(['auth'])->group(function () {
    Route::post('/student', [StudentController::class, 'store'])->name("students.store");
    Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/student/{id}', [StudentController::class, 'update']);
    Route::delete('/student/{id}', [StudentController::class, 'destroy']);
});
