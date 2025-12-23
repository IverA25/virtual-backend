<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           MateriaSeeder::class,
           UsuarioSeeder::class,//Siempre se carga
           TablaConfigSeeder::class, //Siempre se carga
           TagSeeder::class,
           CursoSeeder::class,
           TagCursoSeeder::class
        ]);
    }
}
