<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Materia;
use App\Constants\Estado;



class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $estado=Estado::ACTIVO;
        Materia::create([
            'nombre' => 'Ciencias exactas',
            'abreviatura' => 'C',
            'materia_id' => 0,
            'estado' => $estado,
            'es_eliminado' => 0,
        ]);

        Materia::create([
            'nombre'=>'Filosofia',
             'abreviatura'=>'F',
             'materia_id' => 0,
             'estado'=>$estado,
             'es_eliminado'=>0
        ]);

        Materia::create([
            'nombre'=>'Matematica',
             'abreviatura'=>'M',
             'materia_id' => 0,
             'estado'=>$estado,
             'es_eliminado'=>0
        ]);

    }
}
