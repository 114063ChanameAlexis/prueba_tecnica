<?php

use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('/usuarios', UserController::class);
Route::get('usuarios/getusuarios', [UserController::class, 'index']);
Route::put('usuarios/desactivausuario/{id}', [UserController::class, 'destroy']);
Route::delete('tareas/eliminartarea/{id}', [TaskController::class, 'destroy']);
Route::post('tareas/actualizartareas', [TaskController::class, 'index']);