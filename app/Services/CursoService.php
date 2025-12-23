<?php

namespace App\Services;

use App\Constants\Estado;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoService
{
    public function store($data)
    {
        $curso = Curso::create([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'url_portada' => $data['url_portada'],
            'precio' => $data['precio'],
            'porcentaje_prof' => $data['porcentaje_prof'],
            'profesor_id' => $data['profesor_id'],
            'materia_id' => $data['materia_id'],
            'usuario_id' => $data['usuario_id'],

            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);
        return $curso;
    }
    public function update($data, $cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        $curso->update($data);
        return $curso;
    }
    public function obtenerUno($cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        return $curso;
    }
    public function listarActivos()
    {
        $curso = Curso::where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->get();
        return $curso;
    }
    public function destroy(Curso $curso)
    {
        $curso->es_eliminado = 1;
        $curso->save();
        return $curso;
    }
}
