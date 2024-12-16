<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = [
            [
                'academic_year' => 8,
                'student_id' => 1,
                'subject_id' => 1,
                'is_hidden' => false
            ],
            [
                'academic_year' => 8,
                'student_id' => 1,
                'subject_id' => 2,
                'is_hidden' => false
            ],
            [
                'academic_year' => 6,
                'student_id' => 2,
                'subject_id' => 3,
                'is_hidden' => true
            ],
        ];

        DB::table('enrollments')->insert($enrollments);
    }
}
