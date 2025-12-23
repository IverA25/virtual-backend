<?php

namespace App\Services;

use App\Constants\ErrorMessages;
use App\Constants\Estado;
use App\Constants\SuccessMessages;
use App\Constants\TipoUsuario;
use App\Http\Resources\Usuario\UsuarioResource;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function crearUsuario(array $data): JsonResponse
    {
        try {
            DB::transaction(function () use ($data) {
                $this->createUserWithRelations($data);
            });

            return ResponseService::success(message: SuccessMessages::CREADO_CORRECTAMENTE);
        } catch (\Exception $e) {

            Log::error('Error al crear usuario', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return ResponseService::error(ErrorMessages::ERROR_CREAR, 500);
        }
    }

    private function createUserWithRelations(array $data): void
    {
        $user = User::create([
            'name'           => $data['name'] ?? null,
            'email'          => $data['email'] ?? null,
            'password'       => isset($data['password']) ? Hash::make($data['password']) : 12345678,
            'tipo'           => $data['tipo'] ?? null,
            'estado'         => Estado::ACTIVO,
            'es_eliminado'   => false,
        ]);

        if (isset($data['persona'])) {
            $this->createPersona($data['persona'], $user);
        }
    }

    private function createPersona(array $personaData, User $user): void
    {
        Persona::create([
            'nombre'        => $personaData['nombre'] ?? null,
            'apellido'      => $personaData['apellido'] ?? null,
            'telefono'      => $personaData['telefono'] ?? null,
            'direccion'     => $personaData['direccion'] ?? null,
            'coordenadas'   => $personaData['coordenadas'] ?? null,
            'observacion'   => $personaData['observacion'] ?? null,
            'foto_url'      => $personaData['foto_url'] ?? null,
            'estado'        => Estado::ACTIVO,
            'es_eliminado'  => false,
            'usuario_id'    => $user->id,
        ]);
    }

    public function actualizarUsuario(User $user, array $data): JsonResponse
    {
        $user->update([
            'name' => $data['persona']['nombre'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'tipo' => $data['tipo'] ?? $user->tipo
        ]);

        if (isset($data['persona'])) {
            $user->persona()->update([
                'nombre' => $data['persona']['nombre'],
                'apellido' => $data['persona']['apellido'],
                'telefono' => $data['persona']['telefono'],
                'direccion' => $data['persona']['direccion'],
                'coordenadas' => $data['persona']['coordenadas'] ?? '',
                'observacion' => $data['persona']['observacion'] ?? '',
                'foto_url' => $data['persona']['foto_url'] ?? '',
            ]);
        }

        return response()->json([
            'message' => SuccessMessages::ACTUALIZADO_CORRECTAMENTE,
            'data' => new UsuarioResource($user->fresh())
        ], 200);
    }

    public function eliminarUsuario(User $user): JsonResponse
    {
        $user->update([
            'estado' => Estado::INACTIVO,
            'es_eliminado' => 1,
        ]);
        if ($user->persona) {
            $user->persona->update([
                'estado' => Estado::INACTIVO,
                'es_eliminado' => 1,
            ]);
        }
        return response()->json([
            'message' => SuccessMessages::ELIMINADO_CORRECTAMENTE,
        ], 200);
    }

    public function update($data, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($data);
        return $user;
    }

    public function listarActivos()
    {
        $usuarios = User::where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->get();
        return $usuarios;
    }

    public function obtenerUnUsuario($usuarioId)
    {
        $usuario = User::where('id', $usuarioId)
            ->where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->with([
                'persona:id,nombre,apellido,telefono,usuario_id'
            ])
            ->first();
        return $usuario;
    }
}
