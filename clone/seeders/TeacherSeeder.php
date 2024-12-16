<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'first_name' => 'Sara',
                'last_name' => 'Castañeda',
                'email' => 'sa2501@gmail.com',
                'birthdate' => '1985-02-25',
                'address' => 'Cll 65b NRO 80a -20',
                'phone' => '3104559015',
                'is_hidden' => false
            ],
            [
                'first_name' => 'Efren',
                'last_name' => 'Bedoya',
                'email' => 'efabebe@gmail.com',
                'birthdate' => '1990-05-10',
                'address' => 'Carrera 40',
                'phone' => '3183672890',
                'is_hidden' => true
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Mosquera',
                'email' => 'marianisajo@gmail.com',
                'birthdate' => '1990-07-11',
                'address' => 'Calle 1A #10-11',
                'phone' => '3206989521',
                'is_hidden' => true
            ]
        ];

        DB::table('teachers')->insert($teachers);
    }
}
