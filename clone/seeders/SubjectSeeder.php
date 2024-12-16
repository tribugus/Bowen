<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Inglés',
                'grade_level' => 9,
                'schedule' => '09:20:00',
                'teacher_id' => 1,
                'classroom_id' => 1,
                'is_hidden' => false
            ],
            [
                'name' => 'Física',
                'grade_level' => 11,
                'schedule' => '06:20:00',
                'teacher_id' => 2,
                'classroom_id' => 3,
                'is_hidden' => false
            ],
            [
                'name' => 'Matemáticas',
                'grade_level' => 6,
                'schedule' => '18:30:00',
                'teacher_id' => 2,
                'classroom_id' => 2,
                'is_hidden' => true
            ]
        ];

        DB::table('subjects')->insert($subjects);
    }
}
