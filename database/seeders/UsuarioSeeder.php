<?php

namespace Database\Seeders;

//use App\Models\Permission;
//use App\Models\Roll;
//use App\Models\RolePermission;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $usuarios = [

            [
                'nombre' => 'Gustavo',
                'ap_pat' => 'Meza',
                'ap_mat' => 'Temoltzi',
                'telefono' => '2221712060',
                'activo' => 1,
                'correo' => 'admin@gmail.com',
                'contrasena' => Hash::make('1234'),
                'roll_id' => 1,
            ],

            [
                'nombre' => 'Alberto',
                'ap_pat' => 'Mendoza',
                'ap_mat' => 'Juarez',
                'telefono' => '2223510472',
                'activo' => 1,
                'correo' => 'albert@gmail.com',
                'contrasena' => Hash::make('1212'),
                'roll_id' => 2,
            ],

            [
                'nombre' => 'Juan',
                'ap_pat' => 'Cantoral',
                'ap_mat' => 'Meza',
                'telefono' => '5635104272',
                'activo' => 1,
                'correo' => 'test@gmail.com',
                'contrasena' => Hash::make('1212'),
                'roll_id' => 3,
            ],

            [
                'nombre' => 'Ruben',
                'ap_pat' => 'Canserbero',
                'ap_mat' => 'Ortiz',
                'telefono' => '2234567890',
                'activo' => 1,
                'correo' => 'set@gmail.com',
                'contrasena' => Hash::make('1212'),
                'roll_id' => 4,
            ],

        ];

        collect($usuarios)->each(function ($usuario) { Usuario::create($usuario); });



    }
}






/*$adminRole = new Roll();
$adminRole->name = "Administrador";
$adminRole->save();
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
*/
