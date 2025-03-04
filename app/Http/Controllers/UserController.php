<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // GET
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Obtener un usuario por ID
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user, 200);
    }

    // POST
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:8',
            ], [
                // Personalizando los mensajes de error de validación
                'email.unique' => 'El correo electrónico ya está registrado en otro usuario.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'name.required' => 'El nombre es obligatorio.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'password.required' => 'La contraseña es obligatoria.',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'Usuario creado con éxito',
                'user' => $user
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // PUT
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }

            $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|unique:users,email,' . $id,
                'password' => 'string|min:8|nullable',
            ], [
                // Personalizando los mensajes de error de validación
                'email.unique' => 'El correo electrónico ya está registrado en otro usuario.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            ]);

            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'message' => 'Usuario actualizado con éxito',
                'user' => $user
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // DELETE
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}