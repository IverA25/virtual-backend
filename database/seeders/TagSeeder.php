<?php

namespace Database\Seeders;

use App\Constants\Estado;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'nombre' => 'Ciencia',
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        Tag::create([
            'nombre' => 'Matematica',
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        Tag::create([
            'nombre' => 'psicologia',
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        Tag::create([
            'nombre' => 'vida sana',
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);
        Tag::create([
            'nombre' => 'social',
            'estado' => Estado::ACTIVO,
            'es_eliminado' => 0,
        ]);

    }
}
