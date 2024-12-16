<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TeachersController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;

        if(!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                :  env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $teachers = Teacher::where('first_name', 'LIKE', "%$filter%")
                                ->orWhere('last_name', 'LIKE', "%$filter%")
                                ->paginate($request->records_per_page);
                                
        return view('teachers.index',['teachers' => $teachers, 'data' => $request]);
    }
    
    public function create(){
        return view('teachers.create');
    }
    
    public function store(Request $request) {

        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'address' => 'required|max:100',
            'phone' => 'required|max:15',
            'email' => 'required',
            'birthdate' => 'required',
        ],
        [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'last_name.max' => 'El Apellido no puede ser mayor a :max caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'phone.required' => 'El celular es obligatorio.',
            'phone.max' => 'El celular no puede ser mayor a :max caracteres.',
            'email.required' => 'El email es obligatorio.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.'        

        ])->validate();
    
        try {
            $teacher = new Teacher();
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->address = $request->address;
            $teacher->phone = $request->phone;
            $teacher->email = $request->email;
            $teacher->birthdate = $request->birthdate;
            
            $teacher->save();

            Session::flash('message', ['content' => 'Profesor creado con éxito', 'type' => 'success']);
            return redirect()->action([TeachersController::class, 'index']);

        }catch(Exception $ex){
            
            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
    
}
    public function edit($id) {
        $teacher = Teacher::find($id);

        if(empty($teacher)) {
            Session::flash('message', ['content' => "El profesor con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([TeachersController::class, 'index']);
        }

        return view('teachers.edit', ['teacher' => $teacher]);
    }
    
    public function update(Request $request) {

        $validator = Validator::make($request->all(), 
        [
            'teacher_id' => 'required|numeric|min:1',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'address' => 'required|max:100',
            'phone' => 'required|max:15',
            'email' => 'required',
            'birthdate' => 'required',
        ],
        [
            'teacher_id.required' => 'El teacher_id es obligatorio.',
            'teacher_id.numeric' => 'El teacher_id debe ser un número.',
            'teacher_id.min' => 'El teacher_id no puede ser menor a :min.',
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'last_name.max' => 'El Apellido no puede ser mayor a :max caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'phone.required' => 'El celular es obligatorio.',
            'phone.max' => 'El celular no puede ser mayor a :max caracteres.',
            'email.required' => 'El email es obligatorio.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.'
            

        ])->validate();

        try {
            $teacher = Teacher::find($request->teacher_id);
            
            if(empty($teacher)){
            
                Session::flash('message', ['content' => "El Profesor con id '$request->teacher_id' no existe", 'type' => 'error']);
                return redirect()->action([TeachersController::class, 'index']);
            }

            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->address = $request->address;
            $teacher->phone = $request->phone;
            $teacher->email = $request->email;
            $teacher->birthdate = $request->birthdate;

            $teacher->save();
            Session::flash('message', ['content' => 'Profesor editado con éxito', 'type' => 'success']);
            return redirect()->action([TeachersController::class, 'index']);

        }catch(Exception $ex){
            
            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {    
            $teacher = Teacher::find($id);

            if(empty($teacher)){
                
                Session::flash('message', ['content' => "El profesor con id '$id' no existe", 'type' => 'error']);
            }
            
            $teacher->delete();

            Session::flash('message', ['content' => 'Profesor eliminado con éxito', 'type' => 'success']);
            return redirect()->action([TeachersController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
    }
}