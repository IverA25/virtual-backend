<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;

class Materia extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'nombre',
        'abreviatura',
        'materia_id',
        'estado',
        'es_eliminado'
    ];

}
