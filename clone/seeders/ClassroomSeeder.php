<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = [
            [
                'code' => '203',
                'capacity' => 40,
                'location' => 'Bloque 4',
                'is_hidden' => false
            ],
            [
                'code' => '401',
                'capacity' => 30,
                'location' => 'Bloque 1',
                'is_hidden' => false
            ],
            [
                'code' => '110',
                'capacity' => 20,
                'location' => 'Bloque 3',
                'is_hidden' => true
            ]
        ];

        DB::table('classrooms')->insert($classrooms);
    }
}
