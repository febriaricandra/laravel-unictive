<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\JWTMiddleware;


Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);

Route::middleware([JWTMiddleware::class])->group(function () {
    Route::apiResource('/users', UserController::class);
});