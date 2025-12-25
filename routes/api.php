<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraCursoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\TablaConfigController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagCursoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VerificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('registro', [AuthController::class, 'crearUsuario']);
    });

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('auth/logout', [AuthController::class, 'logout']);

        // Usuarios
        Route::prefix('usuarios')->group(function () {
            Route::get('listar/{user?}', [UserController::class, 'show']);
            Route::get('obtener-uno/{usuarioId}', [UserController::class, 'obtenerUnUsuario']);


            Route::post('crear', [UserController::class, 'crearUsuario']);
            Route::patch('actualizar/{user}', [UserController::class, 'actualizarUsuario']);
            Route::delete('eliminar/{user}', [UserController::class, 'eliminarUsuario']);
        });

        // Perfil del usuario autenticado
        Route::prefix('perfil')->group(function () {
            Route::get('/', [PerfilUsuarioController::class, 'obtenerPerfil']);
            Route::post('actualizar', [PerfilUsuarioController::class, 'actualizarPerfil']);
            Route::post('cambiar-foto', [PerfilUsuarioController::class, 'actualizarFotoPerfil']);
            Route::patch('cambiar-password', [PerfilUsuarioController::class, 'cambiarPassword']);
        });
    });

    // Rutas para la verificación de códigos a correo
    Route::post('send-verification-code', [VerificationController::class, 'sendVerificationCode']);
    Route::post('verify-code', [VerificationController::class, 'verifyCode']);

    //Rutas sin autenticacion
    Route::get('tabla-config/datos', [TablaConfigController::class, 'show']);
    Route::get('tabla-config/aranceles-doc', [TablaConfigController::class, 'obtenerArancelAbogados']);


    Route::middleware(['auth:sanctum'])->group(function () {
        //Materia
        Route::get('materias', [MateriaController::class, 'index']);
        Route::get('materias/listar/{materia?}', [MateriaController::class, 'show']);
        Route::post('materias', [MateriaController::class, 'store']);
        Route::patch('materias/{materia}', [MateriaController::class, 'update']);
        Route::patch('materias/eliminar/{materia}', [MateriaController::class, 'destroy']);

        //Tabla config
        Route::post('tabla-config/actualizar', [TablaConfigController::class, 'update']);
        Route::post('tabla-config/actualizar-arancel', [TablaConfigController::class, 'updataArancelesAbogado']);
        Route::post('tabla-config/actualizar-acuerdos', [TablaConfigController::class, 'updataAcuerdosUsuarios']);
        //Tag
        Route::get('tags', [TagController::class, 'index']);
        Route::get('tags/{tag}', [TagController::class, 'show']);
        Route::get('tags/listar/activos', [TagController::class, 'listarActivos']);
        Route::post('tags', [TagController::class, 'store']);
        Route::patch('tags/{tag}', [TagController::class, 'update']);
        Route::patch('tags/eliminar/{tag}', [TagController::class, 'destroy']);
        //Curso
        Route::get('cursos', [CursoController::class, 'index']);
        Route::get('cursos/{curso}', [CursoController::class, 'show']);
        Route::get('cursos/listar/activos', [CursoController::class, 'listarActivos']);
        Route::post('cursos', [CursoController::class, 'store']);
        Route::patch('cursos/{curso}', [CursoController::class, 'update']);
        Route::patch('cursos/eliminar/{curso}', [CursoController::class, 'destroy']);
        //TagCurso
        Route::get('tag-cursos', [TagCursoController::class, 'index']);
        Route::get('tag-cursos/{tagCurso}', [TagCursoController::class, 'show']);
        Route::get('tag-cursos/listar/activos', [TagCursoController::class, 'listarActivos']);
        Route::post('tag-cursos', [TagCursoController::class, 'store']);
        Route::patch('tag-cursos/{tagCurso}', [TagCursoController::class, 'update']);
        Route::patch('tag-cursos/eliminar/{tagCurso}', [TagCursoController::class, 'destroy']);
        //CompraCurso
        Route::get('compra-cursos', [CompraCursoController::class, 'index']);
        Route::post('compra-cursos', [CompraCursoController::class, 'store']);
        Route::get('compra-cursos/{compraCurso}', [CompraCursoController::class, 'show']);
        Route::get('compra-cursos/listar/activos', [CompraCursoController::class, 'listarActivos']);
        Route::patch('compra-cursos/eliminar/{compraCurso}', [CompraCursoController::class, 'destroy']);
    });
});
