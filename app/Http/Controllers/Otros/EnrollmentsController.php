<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EnrollmentsController extends Controller
{
    public function index(Request $request) {
        $students = Student::all();
        $subjects = Subject::all();

        $filter = $request->filter;

        if(!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                :  env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $enrollments = Enrollment::where('academic_year', 'LIKE', "%$filter%")
                                ->paginate($request->records_per_page);

        return view("enrollments.index", ['enrollments' => $enrollments, 'students' => $students, 'subjects' => $subjects, 'data' => $request]);
    }

    public function create() {
        $students = Student::all();
        $subjects = Subject::all();
        return view("enrollments.create", ['students' => $students, 'subjects' => $subjects]);
    }

    public function store(Request $request) {

        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'academic_year' => 'required',
            'student_id' => 'not_in:0',
            'subject_id' => 'not_in:0',
        ],
        [
            'academic_year.required' => 'El año académico es requerido.',
            'student_id.not_in' => 'El estudiante es requerido.',
            'subject_id.not_in' => 'La asignatura es requerida.'
        ])->validate();

        try {  
            $enrollment = new Enrollment();
            $enrollment->academic_year = $request->academic_year;
            $enrollment->student_id = $request->student_id;
            $enrollment->subject_id = $request->subject_id;

            $enrollment->save();
    
            Session::flash('message', ['content' => 'Matricula creada con éxito', 'type' => 'success']);
            return redirect()->action([EnrollmentsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
        
    }

    public function edit($id) {
        $enrollment = Enrollment::find($id);
        $students = Student::all();
        $subjects = Subject::all();

        if(empty($enrollment)) {
            Session::flash('message', ['content' => "La matricula con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([EnrollmentsController::class, 'index']);
        }

        $studentSelected = Student::find($enrollment->student_id);
        if(empty($studentSelected)){

            abort(404, "El estudiante con id '$enrollment->student_id' no existe");
        }

        $subjectSelected = Subject::find($enrollment->subject_id);
        if(empty($subjectSelected)){

            abort(404, "La asignatura con id '$enrollment->subject_id' no existe");
        }

        return view('enrollments.edit', ['enrollment' => $enrollment, 'students' => $students, 'subjects' => $subjects, 'studentSelected' => $studentSelected, 'subjectSelected' => $subjectSelected]);
    }

    public function update(Request $request) {
    
        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'required|numeric|min:1',
            'academic_year' => 'required',
            'student_id' => 'not_in:0',
            'subject_id' => 'not_in:0',
        ],
        [
            'enrollment_id.required' => 'El enrollment_id es obligatorio.',
            'enrollment_id.numeric' => 'El enrollment_id debe ser un número.',
            'enrollment_id.min' => 'El enrollment_id no puede ser menor a :min.',
            'academic_year.required' => 'El año académico es requerido.',
            'student_id.not_in' => 'El estudiante es requerido.',
            'subject_id.not_in' => 'La asignatura es requerida.'
        ])->validate();

        try {
            $enrollment = Enrollment::find($request->enrollment_id);

            if (empty($enrollment)) {

                Session::flash('message', ['content' => "La Matricula con id '$request->enrollment_id' no existe", 'type' => 'error']);
                return redirect()->action([EnrollmentsController::class, 'index']);
            }

            $enrollment->academic_year = $request->academic_year;
            $enrollment->student_id = $request->student_id;
            $enrollment->subject_id = $request->subject_id;

            $enrollment->save();

            Session::flash('message', ['content' => 'Matricula editada con éxito', 'type' => 'success']);
            return redirect()->action([EnrollmentsController::class, 'index']);

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }

    public function delete($id) {

        try {
            $enrollment = Enrollment::find($id);

            if(empty($enrollment)) {
                Session::flash('message', ['content' => "La matricula con id '$id' no existe", 'type' => 'error']);
            }

            $enrollment->delete();

            Session::flash('message', ['content' => 'Matricula eliminada con éxito', 'type' => 'success']);
            return redirect()->action([EnrollmentsController::class, 'index']);
        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }

    public function getEnrollmentData($id) {
        $enrollment = Enrollment::find($id);

        if(empty($enrollment)) {
            Session::flash('message', ['content' => "La matricula con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([EnrollmentsController::class, 'index']);
        }

        $student = Student::find($enrollment->student_id);;

        if(empty($student)) {
            Session::flash('message', ['content' => "La estudiante con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([EnrollmentsController::class, 'index']);
        }

        $subject = Subject::find($enrollment->subject_id);

        if(empty($subject)) {
            Session::flash('message', ['content' => "La asignatura con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([EnrollmentsController::class, 'index']);
        }
    
        return response()->json([
            'student' => [
                'first_name' => $student->first_name,
                'last_name' => $student->last_name
            ],
            'subject' => [
                'name' => $subject->name
            ],
            'academic_year' => $enrollment->academic_year
        ]);
    }
    
}
