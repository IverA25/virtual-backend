<?php

namespace App\Services;

use App\Constants\Estado;
use App\Models\CompraCurso;
use Illuminate\Http\Request;

class CompraCursoService
{
    public function store($data)
    {
        $compraCurso = CompraCurso::create([
            'curso_id' => $data['curso_id'],
            'user_id' => $data['user_id'],
            'monto' => $data['monto'],
            'porcentaje_prof' => $data['porcentaje_prof'],
            'monto_prof' => $data['monto_prof'],
            'fecha_compra' => $data['fecha_compra'],
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);
        return $compraCurso;
    }
    public function update($data, $compraCursoId)
    {
        $compraCurso = CompraCurso::findOrFail($compraCursoId);
        $compraCurso->update($data);
        return $compraCurso;
    }
    public function obtenerUno($compraCursoId)
    {
        $compraCurso = CompraCurso::findOrFail($compraCursoId);
        return $compraCurso;
    }
    public function listarActivos()
    {
        $compraCurso = CompraCurso::where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->get();
        return $compraCurso;
    }
    public function destroy(CompraCurso $compraCurso)
    {
        $compraCurso->es_eliminado = 1;
        $compraCurso->save();
        return $compraCurso;
    }
}
