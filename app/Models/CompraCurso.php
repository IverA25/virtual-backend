<?php

namespace App\Models;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCurso extends Model
{
    use CommonScopes, HasFactory;
    protected $fillable = [
        'curso_id',
        'user_id',
        'monto',
        'porcentaje_prof',
        'monto_prof',
        'fecha_compra',
        'estado',
        'es_eliminado'
    ];

    public function curso()
    {
        return parent::belongsTo(Curso::class, 'curso_id');
    }
    public function usuarioCompra()
    {
        return parent::belongsTo(User::class, 'user_id');
    }
}
