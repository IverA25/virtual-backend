<?php

namespace App\Models;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoEstudiante extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'curso_id',
        'user_id',
        'monto',
        'fecha',
        'estado',
        'es_eliminado'
    ];
}
