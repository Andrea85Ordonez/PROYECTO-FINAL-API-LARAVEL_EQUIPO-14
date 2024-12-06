<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\peliculaController;
Route::get ('/peliculas',[peliculaController::class,'index']);
//obtener los pelis 
Route::get('/peliculas/{id}', [peliculaController::class,'show']);
//crear estudiantes
Route::post('/peliculas', [peliculaController::class,'store']);
//modificar pelis
Route::put('/peliculas/{id}', [peliculaController::class,'update']);
//modificar pelis
Route::patch('/peliculas/{id}', [peliculaController::class,'updateParcial']);
//eliminar pelis
Route::delete('/peliculas/{id}', [peliculaController::class,'destroy']);