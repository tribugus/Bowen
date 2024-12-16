<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {

        $classrooms = Classroom::select('classrooms.id', 'classrooms.code');
        $classrooms = $classrooms->get();

        $enrollments = Enrollment::select('enrollments.id', 'enrollments.student_id', 'enrollments.subject_id');
        $enrollments = $enrollments->get();

        $grades = Grade::select('grades.id', 'grades.grade', 'grades.enrollment_id');
        $grades = $grades->get();

        $students = Student::select('students.id', 'students.first_name', 'students.last_name');
        $students = $students->get();

        $subjects = Subject::select('subjects.id', 'subjects.name', 'subjects.teacher_id');
        $subjects = $subjects->get();

        $teachers = Teacher::select('teachers.id', 'teachers.first_name', 'teachers.last_name');
        $teachers = $teachers->get();

        // if (!RoleHelper::currentUserIsAdmin()) {

        //     $user =  Auth::user();

        //     $sections = $sections->join('role_sections', 'sections.id', '=', 'role_sections.section_id')
        //                          ->where('role_sections.role_id', '=', $user->role_id);
        // }

        return view("home.index", ['classrooms' => $classrooms, 'enrollments' => $enrollments, 'grades' => $grades, 'students' => $students, 'subjects' => $subjects, 'teachers' => $teachers]);
    }

    public function classroom($id) {

        $classroom = Classroom::find($id);

        if (empty($classroom)) {

            Session::flash('message', ['content' => "El Aula con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.classroom', ['classroom' => $classroom]);
    }

    public function enrollment($id) {

        $students = Student::all();
        $subjects = Subject::all();
        $enrollment = Enrollment::find($id);

        if (empty($enrollment)) {

            Session::flash('message', ['content' => "La matricula con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.enrollment', ['enrollment' => $enrollment, 'students' => $students, 'subjects' => $subjects]);
    }

    public function grade($id) {
        $subjects = Subject::all();
        $enrollments = Enrollment::with('grades')->get();
        $grade = Grade::find($id);
        $averageGrades = DB::table('grades')
                        ->select('enrollment_id', DB::raw('AVG(grade) as average_grade'))
                        ->groupBy('enrollment_id')
                        ->get();

        if (empty($grade)) {

            Session::flash('message', ['content' => "La nota con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.grade', ['grade' => $grade, 'subjects' => $subjects, 'enrollments' => $enrollments, 'averageGrades' => $averageGrades]);
    }

    public function student($id) {

        $student = Student::find($id);

        if (empty($student)) {

            Session::flash('message', ['content' => "El estudiante con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.student', ['student' => $student]);
    }

    public function subject($id) {
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        $subject = Subject::find($id);

        if (empty($subject)) {

            Session::flash('message', ['content' => "La asignatura con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.subject', ['subject' => $subject, 'classrooms' => $classrooms, 'teachers' => $teachers]);
    }

    public function teacher($id) {

        $teacher = Teacher::find($id);

        if (empty($teacher)) {

            Session::flash('message', ['content' => "El estudiante con id '$id' no existe", 'type' => 'error']);
            return redirect()->back();
        }

        return view('home.teacher', ['teacher' => $teacher]);
    }
}
