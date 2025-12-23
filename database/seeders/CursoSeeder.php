<?php

namespace Database\Seeders;

use App\Constants\Estado;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create([
            'nombre' => 'Curso Cripotomoneda',
            'descripcion' => 'Es un curso de criptomoneda',
            'url_portada' => '',
            'precio' => 100,
            'porcentaje_prof' => 10,
            'profesor_id' => 2,
            'materia_id' => 1,
            'usuario_id' => 1,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);

        Curso::create([
            'nombre' => 'Curso Psicologia',
            'descripcion' => 'Es un curso de psicologia',
            'url_portada' => '',
            'precio' => 200,
            'porcentaje_prof' => 20,
            'profesor_id' => 2,
            'materia_id' => 1,
            'usuario_id' => 1,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);

         Curso::create([
            'nombre' => 'Curso Superacion',
            'descripcion' => 'Es un curso de superacion personal',
            'url_portada' => '',
            'precio' => 200,
            'porcentaje_prof' => 20,
            'profesor_id' => 2,
            'materia_id' => 1,
            'usuario_id' => 1,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
    }
}
