<?php

namespace App\Services;

use App\Constants\Estado;
use App\Models\CursoEstudiante;
use Illuminate\Http\Request;

class CursoEstudianteService
{
    public function store($data)
    {
        $cursoEstudiante = CursoEstudiante::create([
            'curso_id' => $data['nombre'],
            'user_id' => $data['descripcion'],
            'monto' => $data['url_portada'],
            'fecha' => $data['precio'],
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);
        return $cursoEstudiante;
    }
    public function update($data, $cursoEstudianteId)
    {
        $cursoEstudiante = CursoEstudiante::findOrFail($cursoEstudianteId);
        $cursoEstudiante->update($data);
        return $cursoEstudiante;
    }
    public function obtenerUno($cursoEstudianteId)
    {
        $cursoEstudiante = CursoEstudiante::findOrFail($cursoEstudianteId);
        return $cursoEstudiante;
    }
    public function listarActivos()
    {
        $cursoEstudiante = CursoEstudiante::where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->get();
        return $cursoEstudiante;
    }
    public function destroy(CursoEstudiante $cursoEstudiante)
    {
        $cursoEstudiante->es_eliminado = 1;
        $cursoEstudiante->save();
        return $cursoEstudiante;
    }
}
