<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('signup',[ProfileController::class, 'signup'])->name('signup');
Route::post('login',[ProfileController::class, 'login'])->name('login');


//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout',[ProfileController::class, 'logout'])->name('logout');
    Route::put('/getusers/{id}',[ProfileController::class, 'getUsers'])->name('getusers');
    Route::put('/update/{id}',[UserController::class, 'updateProfile'])->name('update profile');
});



?>