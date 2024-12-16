<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\NivelEducativo;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class NivelEducativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [

                'clave_identificador' => 'PRIM',
                'descripcion' => 'PRIMARIA',
                'director_usuario_id' => 3,
                'acuerdo_creacion_incorporacion' => 'FGE1993',
                'date' => 'Diciembre / 13 / 2024',
                'fecha_incorporacion' => '2024-12-13',
                'zona_escolar' => '3',
                'denominacion_grado' => 'AÑO',
                'grado_ini' => 1,
                'grado_fin' => 6,
                'matricula_id' => 1,
                'activo' => true,

            ],
        ];

        collect($data)->each(function ($v) { NivelEducativo::create($v); });


    }
}
