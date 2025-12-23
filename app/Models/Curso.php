<?php

namespace App\Models;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'url_portada',
        'precio',
        'porcentaje_prof',
        'profesor_id',
        'materia_id',
        'usuario_id',
        'estado',
        'es_eliminado'
    ];

    public function profesor()
    {
        return parent::belongsTo(User::class, 'profesor_id');
    }
    public function materia()
    {
        return parent::belongsTo(User::class, 'materia_id');
    }
    //Registros que Curso tiene en TagCurso
    public function tagCurso()
    {
        return $this->hasMany(TagCurso::class, 'curso_id', 'id');
    }
}
