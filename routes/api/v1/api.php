<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/signup',[UserController::class, 'signup'])->name('signup');






?>