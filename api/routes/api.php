<?php


use App\Http\Middleware\AdminAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/update', [UserController::class, 'update']);
    Route::get('/user/{username}', [UserController::class, 'getUser']);


    Route::middleware([AdminAccess::class])->group(function (){
        Route::post('/banner', [BannerController::class, 'create']);
        Route::get('/banner', [BannerController::class, 'get']);
        Route::put('/banner/{bannerID}', [BannerController::class, 'update']);
        Route::delete('/banner/{bannerID}', [BannerController::class, 'delete']);
    });


});