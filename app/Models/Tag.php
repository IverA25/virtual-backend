<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;

class Tag extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
        'es_eliminado'
    ];
    //Registros que Tag tiene en TagCurso
    public function tagCurso()
    {
        return $this->hasMany(TagCurso::class, 'tag_id','id');
    }
}
