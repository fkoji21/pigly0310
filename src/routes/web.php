<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::get('/register/step2', [WeightTargetController::class, 'showForm'])->name('register.step2');
Route::post('/register/step2', [WeightTargetController::class, 'store'])->name('register.step2.store');

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs');
});
