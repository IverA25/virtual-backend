<?php

namespace App\Models;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagCurso extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'curso_id',
        'tag_id',
        'estado',
        'es_eliminado'
    ];

    public function curso()
    {
        return parent::belongsTo(Curso::class, 'curso_id');
    }
    public function tag()
    {
        return parent::belongsTo(Tag::class, 'tag_id');
    }
}
