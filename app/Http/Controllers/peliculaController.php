<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelicula;

class peliculaController extends Controller
{
    public function index(){
        $peliculas = Pelicula::all();
        return response()->json($peliculas,200);
    }
}
