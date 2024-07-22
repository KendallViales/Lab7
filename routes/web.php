<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterUserController::class, 'create']) ->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/create', [TaskController::class, 'create']);
Route::get('/tasks/{task}', [TaskController::class, 'show']);
Route::get('/tasks/create', [TaskController::class, 'create'])->middleware('auth')->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth')->name('tasks.store');
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->middleware('auth')->name('tasks.complete');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->middleware('auth')->name('tasks.edit');
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::patch('/tasks/{task}', [TaskController::class, 'complete']);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

