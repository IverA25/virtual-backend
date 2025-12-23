<?php

namespace Database\Seeders;

use App\Constants\Estado;
use App\Models\TagCurso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagCurso::create([
            'curso_id' => 1,
            'tag_id' => 1,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        TagCurso::create([
            'curso_id' => 1,
            'tag_id' => 2,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        TagCurso::create([
            'curso_id' => 1,
            'tag_id' => 3,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        ///curso 2
        TagCurso::create([
            'curso_id' => 2,
            'tag_id' => 1,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        TagCurso::create([
            'curso_id' => 2,
            'tag_id' => 4,
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
    }
}
