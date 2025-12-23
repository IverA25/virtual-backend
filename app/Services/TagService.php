<?php
namespace App\Services;

use App\Constants\Estado;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagService
{
    public function store($data)
    {
        $tag = Tag::create([
            'nombre' => $data['nombre'],
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0
        ]);
        return $tag;
    }
    public function update($data, $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->update($data);
        return $tag;
    }
    public function obtenerUno($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        return $tag;
    }
    public function listarActivos()
    {
        $tag = Tag::where('estado', Estado::ACTIVO)
                     ->where('es_eliminado', 0)
                     ->get();
      return $tag;
    }

}
