<?php

use App\Http\Controllers\api\AuxiliarController;
use App\Http\Controllers\api\ProfesorController;
use App\Http\Controllers\api\RepresentativeController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    //students
    Route::apiResource('/students', StudentController::class);

    //profesores
    Route::apiResource('/profesores', ProfesorController::class);

    //auxiliares
    Route::apiResource('/auxiliars', AuxiliarController::class);

    //representantes
    Route::apiResource('/representatives', RepresentativeController::class);

    //director
    Route::apiResource('/directors', DirectorController::class);
});
