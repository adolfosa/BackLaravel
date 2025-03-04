<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);       // Obtener lista de usuarios
Route::get('/users/{id}', [UserController::class, 'show']);   // Obtener un usuario específico
Route::post('/users', [UserController::class, 'store']);      // Crear usuario
Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar usuario
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar usuario

