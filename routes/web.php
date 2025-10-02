<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('layouts.index');})->name('layouts.index');
Route::resource('clients', ClientController::class);
Route::resource('tasks', TaskController::class);
Route::resource('projects', ProjectController::class);


