<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\EstadoCivil;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['estado_civil' => 'Soltero(a)' ],
            ['estado_civil' => 'Casado(a)' ],
            ['estado_civil' => 'Divorciado(a)' ],
            ['estado_civil' => 'Viudo(a)' ],
        ];

        collect($data)->each(function ($v) { EstadoCivil::create($v); });


    }
}
