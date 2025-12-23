<?php

namespace Database\Seeders;

use App\Constants\TipoUsuario;
use App\Constants\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoUsuario = TipoUsuario::ADMINISTRADOR;
        $estado = Estado::ACTIVO;
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'tipo' => $tipoUsuario,
            'estado' => $estado,
            'es_eliminado' => 0
        ]);

        Persona::create([
            'nombre' => $user->name,
            'apellido' => 'nuevo',
            'telefono' => '76765443',
            'direccion' => 'Calle sur',
            'coordenadas' => '',
            'observacion' => '',
            'foto_url' => '',
            'estado' => $estado,
            'es_eliminado' => 0,
            'usuario_id' => $user->id,

        ]);
        //PROFESOR
        $user = User::create([
            'name' => 'Leonel',
            'email' => 'profesor@example.com',
            'password' => Hash::make('profesor123'),
            'tipo' => TipoUsuario::PROFESOR,
            'estado' => $estado,
            'es_eliminado' => 0
        ]);
        Persona::create([
            'nombre' => $user->name,
            'apellido' => 'Hots',
            'telefono' => '66565656',
            'direccion' => 'Springfield',
            'coordenadas' => '',
            'observacion' => '',
            'foto_url' => '',
            'estado' => $estado,
            'es_eliminado' => 0,
            'usuario_id' => $user->id,
        ]);
        
    
        //estudiante
        $userdep = User::create([
            'name' => 'Junior',
            'email' => 'junior@example.com',
            'password' => Hash::make('junior123'),
            'tipo' => TipoUsuario::ESTUDIANTE,
            'estado' => $estado,
            'es_eliminado' => 0
        ]);
        Persona::create([
            'nombre' => $userdep->name,
            'apellido' => 'Blas',
            'telefono' => '76764643',
            'direccion' => 'Springfield',
            'coordenadas' => '',
            'observacion' => '',
            'foto_url' => '',
            'estado' => $estado,
            'es_eliminado' => 0,
            'usuario_id' => $userdep->id,
        ]);

        //estudiante 2
        $user = User::create([
            'name' => 'Lalo',
            'email' => 'lalo@example.com',
            'password' => Hash::make('lalo123'),
            'tipo' => TipoUsuario::ESTUDIANTE,
            'estado' => $estado,
            'es_eliminado' => 0
        ]);
        Persona::create([
            'nombre' => $user->name,
            'apellido' => 'Landa',
            'telefono' => '77764654',
            'direccion' => 'Springfield',
            'coordenadas' => '',
            'observacion' => '',
            'foto_url' => '',
            'estado' => $estado,
            'es_eliminado' => 0,
            'usuario_id' => $user->id,
        ]);
       
       
    }
}
