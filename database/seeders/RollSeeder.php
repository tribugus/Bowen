<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\Roll;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $fechaHora = Carbon::now()->format('Y-m-d H:i:s');


        $rolls = [
            ['roll' => 'administrador', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'admin', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'director', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'profesor', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'tutor', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'padres', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
            ['roll' => 'estudiante', 'activo' => true, 'hash' => Hash::make($fechaHora) ],
        ];

        collect($rolls)->each(function ($roll) { Roll::create($roll); });




    }
}
