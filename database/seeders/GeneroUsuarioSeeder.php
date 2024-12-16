<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\GeneroUsuario;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class GeneroUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['genero' => 'Masculino' ],
            ['genero' => 'Femenino' ],
            ['genero' => 'Otro' ],
        ];

        collect($data)->each(function ($v) { GeneroUsuario::create($v); });

                         

    }
}
