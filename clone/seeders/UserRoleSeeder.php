<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $adminRole = new Role();
        $adminRole->name = "Administrador";
        $adminRole->save();

        $user = new User();
        $user->first_name = "Gustavo";
        $user->last_name = "Meza";
        $user->document = "1993";
        $user->email = "admin@gmail.com";
        $user->email_verified_at = now();
        $user->password = Hash::make('1234');
        $user->role_id = $adminRole->id;
        $user->save();


    }
}
