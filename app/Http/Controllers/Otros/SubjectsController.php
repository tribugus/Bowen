<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{
    public function index(Request $request) {
        $classrooms = Classroom::all();
        $teachers = Teacher::all();

        $filter = $request->filter;

        if(!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                :  env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $subjects = Subject::where('name', 'LIKE', "%$filter%")
                                ->paginate($request->records_per_page);

        return view("subjects.index", ['subjects' => $subjects, 'teachers' => $teachers, 'classrooms' => $classrooms, 'data' => $request]);
    }

    public function create() {
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        return view("subjects.create", ['teachers' => $teachers, 'classrooms' => $classrooms]);
    }

    public function store(Request $request) {

        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'grade_level' => 'required',
            'schedule' => 'required',
            'teacher_id' => 'not_in:0',
            'classroom_id' => 'not_in:0',
        ],
        [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'grade_level.required' => 'El grado es obligatorio.',
            'schedule.required' => 'El horario es obligatorio.',
            'teacher_id.not_in' => 'El profesor es requerido.',
            'classroom_id.not_in' => 'El aula es requerida.'

        ])->validate();

        try {  
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->grade_level = $request->grade_level;
            $subject->schedule = $request->schedule;
            $subject->teacher_id = $request->teacher_id;
            $subject->classroom_id = $request->classroom_id;

            $subject->save();
    
            Session::flash('message', ['content' => 'Asignatura creada con éxito', 'type' => 'success']);
            return redirect()->action([SubjectsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
        
    }

    public function edit($id) {
        $subject = Subject::find($id);
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        if(empty($subject)) {
            Session::flash('message', ['content' => "La asignatura con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([SubjectsController::class, 'index']);
        }

        $teacherSelected = Teacher::find($subject->teacher_id);
        if(empty($teacherSelected)){

            abort(404, "El profesor con id '$subject->teacher_id' no existe");
        }

        $classroomSelected = Classroom::find($subject->classroom_id);
        if(empty($classroomSelected)){

            abort(404, "El aula con id '$subject->classroom_id' no existe");
        }

        return view('subjects.edit', ['subject' => $subject, 'classrooms' => $classrooms, 'teachers' => $teachers, 'classroomSelected' => $classroomSelected, 'teacherSelected' => $teacherSelected]);
    }

    public function update(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|numeric|min:1',
            'name' => 'required|max:25',
            'grade_level' => 'required',
            'schedule' => 'required',
            'teacher_id' => 'not_in:0',
            'classroom_id' => 'not_in:0',
        ],
        [
            'subject_id.required' => 'El subject_id es obligatorio.',
            'subject_id.numeric' => 'El subject_id debe ser un número.',
            'subject_id.min' => 'El subject_id no puede ser menor a :min.',
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'grade_level.required' => 'El grado es obligatorio.',
            'schedule.required' => 'El horario es obligatorio.',
            'teacher_id.not_in' => 'El profesor es requerido.',
            'classroom_id.not_in' => 'El aula es requerida.'

        ])->validate();

        try {
            $subject = Subject::find($request->subject_id);

            if (empty($subject)) {

                Session::flash('message', ['content' => "La asignatura con id '$request->subject_id' no existe", 'type' => 'error']);
                return redirect()->action([SubjectsController::class, 'index']);
            }

            $subject->name = $request->name;
            $subject->grade_level = $request->grade_level;
            $subject->schedule = $request->schedule;
            $subject->teacher_id = $request->teacher_id;
            $subject->classroom_id = $request->classroom_id;

            $subject->save();

            Session::flash('message', ['content' => 'Asignatura editada con éxito', 'type' => 'success']);
            return redirect()->action([SubjectsController::class, 'index']);

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }

    public function delete($id) {

        try {
            $subject = Subject::find($id);

            if(empty($subject)) {
                Session::flash('message', ['content' => "La asignatura con id '$id' no existe", 'type' => 'error']);
            }

            $subject->delete();

            Session::flash('message', ['content' => 'Asignatura eliminada con éxito', 'type' => 'success']);
            return redirect()->action([SubjectsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }
}
