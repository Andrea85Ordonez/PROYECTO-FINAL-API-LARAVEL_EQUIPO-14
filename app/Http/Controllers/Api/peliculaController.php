<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Validator;

class peliculaController extends Controller
{
    public function index(){
        $peliculas = Pelicula::all();
        if ($peliculas->isEmpty()){
            return response()->json(['mensaje'=>'No hay peliculas registrados']
            ,404);

        }
        return response()->json($peliculas,200);
    }
    public function store(Request $requerimiento){
        $validar=Validator::make($requerimiento->all(),[
            'titulo'=>'required',
            'fecha'=>'required',
            'Descripcion'=>'required',
            'Tipo'=>'required',
            'urlImagen'=>'required'
        ]);
        if($validar->fails()){
            $data=[
                'mensaje'=>'Erros de validacion de datos',
                'error'=>$validar->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $pelicula=Pelicula::create([
            'titulo'=>$requerimiento->input('titulo'),
            'fecha'=>$requerimiento->input('fecha'),
            'Descripcion'=>$requerimiento->input('Descripcion'),
            'Tipo'=>$requerimiento->input('Tipo'),
            'urlImagen'=>$requerimiento->input('urlImagen')
        ]);
        if(!$pelicula){
            $data=[
                'mensaje'=>'Erros de crear pelicula',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'pelicula' => $pelicula,
            'status' =>201
        ];
        return response()->json($data,201);
    }
    public function show($id){
        $pelicula=Pelicula::find($id);
        if(!$pelicula){
            $data=[
                'mensaje'=>'Pelicula no encontrada',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $data=[
            'pelicula'=>$pelicula,
            'status'=>200
        ];
        return response()->json($data,200);

    }
    public function destroy($id){
        $pelicula=Pelicula::find($id);
        if(!$pelicula){
            $data=[
                'mensaje'=>'Pelicula no encontrada',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $pelicula->delete();
        $data=[
            'mensaje'=>'Pelicula eliminada',
            'status'=>200
        ];
        return response()->json($data,200);

    }
    public function update(Request $requerimiento,$id){
        $pelicula=Pelicula::find($id);
        if(!$pelicula){
            $data=[
                'mensaje'=>'Pelicula no encontrada',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $validar=Validator::make($requerimiento->all(),[
            'titulo'=>'required',
            'fecha'=>'required',
            'Descripcion'=>'required',
            'Tipo'=>'required',
            'urlImagen'=>'required'
        ]);
        if($validar->fails()){
            $data=[
                'mensaje'=>'Erros de validacion de datos',
                'error'=>$validar->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $pelicula->titulo = $requerimiento->titulo;
        $pelicula->fecha = $requerimiento->fecha;
        $pelicula->Descripcion = $requerimiento->Descripcion;
        $pelicula->Tipo = $requerimiento->Tipo;
        $pelicula->urlImagen = $requerimiento->urlImagen;
        $pelicula->save();
        $data=[
            'mensaje'=>'Pelicula actualizada',
            'pelicula'=>$pelicula,
            'status'=>200
        ];
        return response()->json($data,200);
       
    }
    public function updateParcial(Request $requerimiento, $id)
    {
        $pelicula = Pelicula::find($id);
        if (!$pelicula) {
            $data = [
                'mensaje' => 'Pelicula no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        if ($requerimiento->has('titulo')) {
            $pelicula->titulo = $requerimiento->input('titulo');
        }
        if ($requerimiento->has('fecha')) {
            $pelicula->fecha = $requerimiento->input('fecha');
        }
        if ($requerimiento->has('Descripcion')) {
            $pelicula->Descripcion = $requerimiento->input('Descripcion');
        }
        if ($requerimiento->has('Tipo')) {
            $pelicula->Tipo = $requerimiento->input('Tipo');
        }
        if ($requerimiento->has('urlImagen')) {
            $pelicula->urlImagen = $requerimiento->input('urlImagen');
        }
        $pelicula->save();
        $data = [
            'mensaje' => 'Pelicula actualizada parcialmente',
            'pelicula' => $pelicula,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}