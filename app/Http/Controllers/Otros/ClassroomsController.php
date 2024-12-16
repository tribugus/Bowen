<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClassroomsController extends Controller
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

        $classrooms = Classroom::where('code', 'LIKE', "%$filter%")
                                ->paginate($request->records_per_page);

        return view('classrooms.index', ['classrooms' => $classrooms,
                                    'data' => $request]);

    }

    public function create() {
        return view("classrooms.create");
    }

    public function store(Request $request) {

        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:10',
            'capacity' => 'required',
            'location' => 'required|max:30'
        ],
        [
            'code.required' => 'El código del aula es obligatorio.',
            'code.max' => 'El código del aula no puede ser mayor a :max caracteres.',
            'capacity.required' => 'La capacidad del aula es requerida.',
            'location.required' => 'La localización del aula es obligatoria.',
            'location.max' => 'La localización del aula no puede ser mayor a :max caracteres.'

        ])->validate();

        try {  
            $classroom = new Classroom();
            $classroom->code = $request->code;
            $classroom->capacity = $request->capacity;
            $classroom->location = $request->location;

            $classroom->save();
    
            Session::flash('message', ['content' => 'Aula creada con éxito', 'type' => 'success']);
            return redirect()->action([ClassroomsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }
        
    }

    public function edit($id) {
        $classroom = Classroom::find($id);

        if(empty($classroom)) {
            Session::flash('message', ['content' => "El aula con id '$id' no existe", 'type' => 'error']);
            return redirect()->action([ClassroomsController::class, 'index']);
        }

        return view('classrooms.edit', ['classroom' => $classroom]);
    }

    public function update(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required|numeric|min:1',
            'code' => 'required|max:10',
            'capacity' => 'required',
            'location' => 'required|max:30'
        ],
        [
            'classroom_id.required' => 'El classroom_id es obligatorio.',
            'classroom_id.numeric' => 'El classroom_id debe ser un número.',
            'classroom_id.min' => 'El classroom_id no puede ser menor a :min.',
            'code.required' => 'El código del aula es obligatorio.',
            'code.max' => 'El código del aula no puede ser mayor a :max caracteres.',
            'capacity.required' => 'La capacidad del aula es requerida.',
            'location.required' => 'La localización del aula es obligatoria.',
            'location.max' => 'La localización del aula no puede ser mayor a :max caracteres.'

        ])->validate();

        try {
            $classroom = Classroom::find($request->classroom_id);

            if (empty($classroom)) {

                Session::flash('message', ['content' => "El aula con id '$request->classroom_id' no existe", 'type' => 'error']);
                return redirect()->action([ClassroomsController::class, 'index']);
            }

            $classroom->code = $request->code;
            $classroom->capacity = $request->capacity;
            $classroom->location = $request->location;

            $classroom->save();

            Session::flash('message', ['content' => 'Aula editada con éxito', 'type' => 'success']);
            return redirect()->action([ClassroomsController::class, 'index']);

        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }

    public function delete($id) {

        try {
            $classroom = Classroom::find($id);

            if(empty($classroom)) {
                Session::flash('message', ['content' => "El aula con id '$id' no existe", 'type' => 'error']);
            }

            $classroom->delete();

            Session::flash('message', ['content' => 'Aula eliminada con éxito', 'type' => 'success']);
            return redirect()->action([ClassroomsController::class, 'index']);
            
        }catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', ['content' => "Ha ocurrido un error", 'type' => 'error']);
            return redirect()->back();
        }

    }
}
