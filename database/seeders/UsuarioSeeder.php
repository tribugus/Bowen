<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        Usuario::create([
            'nombre' => 'test',
            'ap_pat' => 'test',
            'ap_mat' => 'test',
            'correo' => 'test',
            'contrasena' => 'test',
            'roll_id' => 1,
            'telefono' => 'test',
            'activo' => 1,
        ]);



    }
}
