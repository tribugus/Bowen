<?php

namespace Database\Seeders;

//use App\Models\Permission;
//use App\Models\Roll;
//use App\Models\RolePermission;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioRollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        /*$adminRole = new Roll();
        $adminRole->name = "Administrador";
        $adminRole->save();*/

        $user = new Usuario();
        $user->ap_pat = "Meza";
        $user->ap_mat = "Gustavo";
        $user->nombre = "1993";
        $user->telefono = "2221712060";
        $user->activo = 1;
        $user->correo = "admin@gmail.com";
        $user->contrasena = Hash::make('1234');
        $user->roll_id = 1;
        //$user->role_id = $adminRole->id;
        $user->save();


    }
}
