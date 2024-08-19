<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/update', [UserController::class, 'update']);
    Route::get('/user/{username}', [UserController::class, 'getUser']);

});