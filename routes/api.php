<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('signup',[ProfileController::class, 'signup'])->name('signup');
Route::post('login',[ProfileController::class, 'login'])->name('login');
Route::post('/message',[HomeController::class, 'message'])->name('messsage');
Route::post('/userprofile/{id}',[ProfileController::class, 'userProfile'])->name('user profile');


//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/forgotpassword/{id}',[ProfileController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('/logout',[ProfileController::class, 'logout'])->name('logout');
Route::get('/getusers/{id}',[ProfileController::class, 'getUsers'])->name('getusers');
Route::post('/updateprofile/{id}',[ProfileController::class,'updateProfile'])->name('updateprofile');
    
});




?>