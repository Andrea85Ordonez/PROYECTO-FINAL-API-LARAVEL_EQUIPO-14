<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class usuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        if ($usuarios->isEmpty()) {
            return response()->json(['mensaje' => 'No hay usuarios registrados'], 404);
        }
        return response()->json($usuarios, 200);
    }

    public function store(Request $requerimiento)
    {
        $validar = Validator::make($requerimiento->all(), [
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8',
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'avatar' => 'nullable|url'
        ]);

        if ($validar->fails()) {
            $data = [
                'mensaje' => 'Errores de validación de datos',
                'error' => $validar->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuario::create([
            'email' => $requerimiento->input('email'),
            'password' => bcrypt($requerimiento->input('password')),
            'name' => $requerimiento->input('name'),
            'role' => $requerimiento->input('role'),
            'avatar' => $requerimiento->input('avatar')
        ]);

        $data = [
            'usuario' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario, 200);
    }

    public function update(Request $requerimiento, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $validar = Validator::make($requerimiento->all(), [
            'email' => 'nullable|email|unique:usuarios,email,' . $id,
            'password' => 'nullable|min:8',
            'name' => 'nullable|string|max:255',
            'role' => 'nullable|string',
            'avatar' => 'nullable|url'
        ]);

        if ($validar->fails()) {
            $data = [
                'mensaje' => 'Errores de validación de datos',
                'error' => $validar->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario->update(array_filter($requerimiento->all(), fn($value) => $value !== null));

        return response()->json(['mensaje' => 'Usuario actualizado', 'usuario' => $usuario], 200);
    }

    public function updateParcial(Request $requerimiento, $id)
    {
        return $this->update($requerimiento, $id);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario eliminado'], 200);
    }
}
