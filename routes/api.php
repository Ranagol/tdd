<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JokeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChuckNorrisController;

// Resource routes for User
Route::resource('users', UserController::class);


//Get a joke from Chuck Norris API
Route::get('/chuck-norris', ChuckNorrisController::class);


