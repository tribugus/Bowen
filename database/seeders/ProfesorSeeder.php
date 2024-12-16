<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\Profesor;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
               
                'clave_profesor' => 'PROF3580',
                'genero_usuario_id' => 1,
                'date' => 'Abril / 07 / 1993',
                'fecha_nacimiento' => '1993-04-07',
                'lugar_nacimiento' => 'MEXICO - PUEBLA',
                'estado_civil_id' => 1,
                'curp' => 'RUCX296748',
                'no_seguro_social' => 'NSS13298598',
                'cedula_fiscal_rfc' => 'REF4984984',
                'usuario_id' => 4,
                'activo' => true,

            ],
        ];

        collect($data)->each(function ($v) { Profesor::create($v); });


    }
}
