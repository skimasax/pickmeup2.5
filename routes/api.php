<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//public routes
Route::get('/signup',[UserController::class, 'signup'])->name('signup');
Route::post('/login',[UserController::class, 'login'])->name('login');

//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/getusers/{id}',[UserController::class, 'getUsers'])->name('getusers');
    Route::post('/update/{id}',[UserController::class, 'updateProfile'])->name('update profile');
});



?>