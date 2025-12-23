<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Constants\TipoUsuario;
use App\Constants\Estado;
use App\Enums\MessageHttp;
use App\Http\Requests\Usuarios\StoreUserRegisterRequest;
use App\Http\Resources\Usuario\UsuarioResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function crearUsuario(StoreUserRegisterRequest $request): JsonResponse
    {
        return $this->userService->crearUsuario($request->validated());
    }

    public function actualizarUsuario(Request $request, User $user): JsonResponse
    {
        return $this->userService->actualizarUsuario($user, $request->all());
    }

    public function eliminarUsuario(User $user): JsonResponse
    {
        return $this->userService->eliminarUsuario($user);
    }

    public function show(User $user = null)
    {
        if ($user) {
            $data = [
                'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
                'data' => $user
            ];
        } else {
            $usuarios = $this->userService->listarActivos();
            $data = [
                'message' => MessageHttp::OBTENIDOS_CORRECTAMENTE,
                'data' => $usuarios
            ];
        }

        return response()->json($data);
    }

    public function obtenerUnUsuario($usuarioId)
    {
        $usuario = $this->userService->obtenerUnUsuario($usuarioId);
        $data = [
            'message' => MessageHttp::OBTENIDO_CORRECTAMENTE,
            'data' => $usuario
        ];
        return response()->json($data);
    }
}
