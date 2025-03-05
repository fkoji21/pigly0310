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
    Route::get('/', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
    Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit'])->name('weight_logs.goal_setting');
    Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])->name('weight_logs.goal_update');
});
