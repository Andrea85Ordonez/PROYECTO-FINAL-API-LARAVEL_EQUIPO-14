<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\peliculaController;
use App\Http\Controllers\Api\usuarioController;


Route::get ('/peliculas',[peliculaController::class,'index']);
//obtener los pelis 
Route::get('/peliculas/{id}', [peliculaController::class,'show']);
//crear peliculas
Route::post('/peliculas', [peliculaController::class,'store']);
//modificar pelis
Route::put('/peliculas/{id}', [peliculaController::class,'update']);
//modificar pelis
Route::patch('/peliculas/{id}', [peliculaController::class,'updateParcial']);
//eliminar pelis
Route::delete('/peliculas/{id}', [peliculaController::class,'destroy']);


Route::get ('/usuarios',[usuarioController::class,'index']);
//obtener los usuarios 
Route::get('/usuarios/{id}', [usuarioController::class,'show']);
//crear usuarios
Route::post('/usuarios', [usuarioController::class,'store']);
//modificar usuarios
Route::put('/usuarios/{id}', [usuarioController::class,'update']);
//modificar usuarios
Route::patch('/usuarios/{id}', [usuarioController::class,'updateParcial']);
//eliminar usuarios
Route::delete('/usuarios/{id}', [usuarioController::class,'destroy']);