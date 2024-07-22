<?php

use App\Http\Controllers\api\AuxiliarController;
use App\Http\Controllers\api\ProfesorController;
use App\Http\Controllers\api\RepresentativeController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\DirectorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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