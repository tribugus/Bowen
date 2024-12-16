<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\CicloEscolar;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class CicloEscolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'ano_ini' => '2024',
                'ano_fin' => '2030',
                'periodo' => '1',
                'descripcion' => 'Ciclo escolar 2024',
                'denominacion' => 'SEMESTRAL',
                'abreviatura' => 'SEM12024',
                'codigo' => '2754',
                'date_ini' => 'Diciembre / 13',
                'date_fin' => 'Diciembre / 01',
                'fecha_ini' => '2024-12-13',
                'fecha_fin' => '2030-12-01',
                'activo' => true,
            ],
        ];

        collect($data)->each(function ($v) { CicloEscolar::create($v); });


    }
}
