<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'enrollment_id' => 1,
                'grade' => 4.0,
                'is_hidden' => false
            ],
            [
                'enrollment_id' => 2,
                'grade' => 5.0,
                'is_hidden' => false
            ],
            [
                'enrollment_id' => 3,
                'grade' => 4.3,
                'is_hidden' => true 
            ]
        ];
        DB::table('grades')->insert($grades);

    }
}
