<?php

namespace App\Services;

use App\Constants\Estado;
use App\Models\TagCurso;
use Illuminate\Http\Request;

class TagCursoService
{
    public function store($data)
    {
        $tagCrso = TagCurso::create([
            'curso_id' => $data['curso_id'],
            'tag_id' => $data['tag_id'],
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);
        return $tagCrso;
    }
    public function update($data, $tagCursoId)
    {
        $tagCurso = TagCurso::findOrFail($tagCursoId);
        $tagCurso->update($data);
        return $tagCurso;
    }
    public function obtenerUno($tagCursoId)
    {
        $tagCurso = TagCurso::findOrFail($tagCursoId);
        return $tagCurso;
    }
    public function listarActivos()
    {
        $tagCurso = TagCurso::where('estado', Estado::ACTIVO)
            ->where('es_eliminado', 0)
            ->get();
        return $tagCurso;
    }
    public function destroy(TagCurso $tagCurso)
    {
        $tagCurso->es_eliminado = 1;
        $tagCurso->save();
        return $tagCurso;
    }
}
