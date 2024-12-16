<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\Matricula;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'formato' => 'a[aaaa]',
                'activo' => true,
                'ini_matricula' => '1',
                'consecutivo_matricula' => '1',
                'limite_matricula' => '200',
                'permitir_modificar' => false,
            ],
        ];

        collect($data)->each(function ($v) { Matricula::create($v); });


    }
}
