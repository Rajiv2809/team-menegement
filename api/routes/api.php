<?php


use App\Http\Middleware\AdminAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TeamSquadController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {


    Route::get('/user/{username}', [UserController::class, 'getUser']);
    Route::post('/user', [UserController::class, 'updateUser']);

    Route::get('/captcha/requestToken', [CaptchaController::class, 'requestToken']);
    Route::get('/captcha/{token}', [CaptchaController::class, 'generate']);
    Route::post('/captcha/verify', [CaptchaController::class, 'verify']);
    Route::middleware([AdminAccess::class])->group(function (){


        Route::post('/banner', [BannerController::class, 'create']);
        Route::get('/banner', [BannerController::class, 'get']);
        Route::put('/banner/{bannerID}', [BannerController::class, 'update']);
        Route::delete('/banner/{bannerID}', [BannerController::class, 'delete']);

        Route::post('/team-squad', [TeamSquadController::class, 'create']);
        Route::get('/team-squad', [TeamSquadController::class, 'get']);
        Route::post('/team-squad/{squadID}', [TeamSquadController::class, 'update']);
        Route::delete('/team-squad/{squadID}', [TeamSquadController::class, 'delete']);

        Route::post('/team-member', [TeamMemberController::class, 'create']);
        Route::get('/team-member/{squadID}', [TeamMemberController::class, 'get']);
        Route::post('/team-member/{memberID}', [TeamMemberController::class, 'update']);
        Route::delete('/team-member/{memberID}', [TeamMemberController::class, 'delete']);
    });

});