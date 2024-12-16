<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class StudentsController extends Controller
{
    public function index(Request $request) {
        $filter = $request->filter;

        if(!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                :  env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $students = Student::where('first_name', 'LIKE', "%$filter%")
                                ->orWhere('last_name', 'LIKE', "%$filter%")
                                ->paginate($request->records_per_page);

        return view("students.index", ['students' => $students, 'data' => $request]);
    }

    public function create() {
        return view("students.create");
    }

    public function store(Request $request) {

        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required|max:10',
            'address' => 'required|max:100',
            'phone_number' => 'required|max:15',
        ],
        [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'last_name.max' => 'El Apellido no puede ser mayor a :max caracteres.',
            'email.required' => 'El email es obligatorio.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'gender.required' => 'El Género es obligatorio.',
            'gender.max' => 'El Género no puede ser mayor a :max caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'phone_number.required' => 'El celular es obligatorio.',
            'phone_number.max' => 'El celular no puede ser mayor a :max caracteres.'

        ])->validate();

        try {  
            $student = new Student();
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->date_of_birth = $request->date_of_birth;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->phone_number = $request->phone_number;

            $student->save();
    
            Session::flash('message', ['content' => 'Estudiante creado con éxito', 'type' => 'success']);
            return redirect()->action([StudentsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
        
    }

    public function edit($id) {
        $student = Student::find($id);

        if(empty($student)) {
            Session::flash('message', ['content' => "El estudiante con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([StudentsController::class, 'index']);
        }

        return view('students.edit', ['student' => $student]);
    }

    public function update(Request $request) {
    
        $validator = Validator::make($request->all(), [                
            'student_id' => 'required|numeric|min:1',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required|max:10',
            'address' => 'required|max:100',
            'phone_number' => 'required|max:15',
        ],
        [
            'student_id.required' => 'El student_id es obligatorio.',
            'student_id.numeric' => 'El student_id debe ser un número.',
            'student_id.min' => 'El student_id no puede ser menor a :min.',
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'last_name.max' => 'El Apellido no puede ser mayor a :max caracteres.',
            'email.required' => 'El email es obligatorio.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'gender.required' => 'El Género es obligatorio.',
            'gender.max' => 'El Género no puede ser mayor a :max caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'phone_number.required' => 'El celular es obligatorio.',
            'phone_number.max' => 'El celular no puede ser mayor a :max caracteres.'
    
        ])->validate();

        try {
            $student = Student::find($request->student_id);

            if (empty($student)) {

                Session::flash('message', ['content' => "El Estudiante con id '$request->student_id' no existe", 'type' => 'error']);
                return redirect()->action([StudentsController::class, 'index']);
            }

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->date_of_birth = $request->date_of_birth;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->phone_number = $request->phone_number;

            $student->save();

            Session::flash('message', ['content' => 'Estudiante editado con éxito', 'type' => 'success']);
            return redirect()->action([StudentsController::class, 'index']);

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }

    public function delete($id) {

        try {
            $student = Student::find($id);

            if(empty($student)) {
                Session::flash('message', ['content' => "El estudiante con id '$id' no existe", 'type' => 'error']);
            }

            $student->delete();

            Session::flash('message', ['content' => 'Estudiante eliminado con éxito', 'type' => 'success']);
            return redirect()->action([StudentsController::class, 'index']);
        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }
}
