<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;

Route::resource('boards', BoardController::class);
Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::patch('tasks/{task}/complete', [\App\Http\Controllers\TaskController::class, 'complete'])->name('tasks.complete');

Route::get('/', [TaskController::class, 'index'])->name('home');