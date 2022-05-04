<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/signup',[UserController::class, 'signup'])->name('signup');
Route::post('/getusers/{id}',[UserController::class, 'getUsers'])->name('getusers');
Route::post('/update/{id}',[UserController::class, 'updateProfile'])->name('update profile');
Route::post('/login',[UserController::class, 'login'])->name('login');





?>