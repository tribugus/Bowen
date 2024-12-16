<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'first_name' => 'Carlos',
                'last_name' => 'Arango',
                'email' => 'carlosarango3101@gmail.com',
                'date_of_birth' => '2005-01-31',
                'gender' => 'Masculino',
                'address' => 'Cll 42 NRO 24 - 05',
                'phone_number' => '3163338891',
                'is_hidden' => false
            ],
            [
                'first_name' => 'Juan',
                'last_name' => 'Machado',
                'email' => 'jmachado@gmail.com',
                'date_of_birth' => '2000-06-03',
                'gender' => 'Masculino',
                'address' => 'AV 80',
                'phone_number' => '3129380812',
                'is_hidden' => true
            ],
            [
                'first_name' => 'Alejandra ',
                'last_name' => 'Sanchez',
                'email' => 'jalesan@gmail.com',
                'date_of_birth' => '2004-04-16',
                'gender' => 'Femenino',
                'address' => 'Edificio Malena',
                'phone_number' => '3216246503',
                'is_hidden' => true
            ],
        ];

        DB::table('students')->insert($students);
    }
}
