<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class RollController extends Controller
{


    public function index(Request $request){



        $data = Roll::where('activo',true)->where('id', '!=', 1)
        ->withCount(['usuarios as usuarios_activos' => function($query) {
            $query->where('activo', true);  // Filtra los usuarios activos
        }])
        ->withCount(['usuarios as usuarios_inactivos' => function($query) {
            $query->where('activo', false);  // Filtra los usuarios activos
        }])
        ->get();

  

        return view('roles.index',['data' => $data]);

    }


    public function inactivo(Request $request){



        $data = Roll::where('activo',false)->where('id', '!=', 1)
        ->withCount(['usuarios as usuarios_activos' => function($query) {
            $query->where('activo', true);  // Filtra los usuarios activos
        }])
        ->withCount(['usuarios as usuarios_inactivos' => function($query) {
            $query->where('activo', false);  // Filtra los usuarios activos
        }])
        ->get();

  

        return view('roles.inactivos',['data' => $data]);

    }


    public function crear(Request $request){


        return view('roles.crear');

    }




    public function store(Request $request) {


        Validator::make($request->all(), [
            'rol' => 'required|unique:tc_roll,roll|min:5',
        ],
        [
            'rol.required' => 'El rol es requerido.',
            'rol.unique' => 'El rol ya existe.',
            'rol.min' => 'El rol debe tener al menos 5 caracteres.'
        ])->validate();




        try {



            $Roll = new Roll();
            $Roll->roll = $request->rol;
            $Roll->hash = Hash::make(Carbon::now()->format('Y-m-d H:i:s'));
            $Roll->activo = true;
            $Roll->save();

            Session::flash('message', ['content' => 'Rol creado con éxito', 'type' => 'success']);
            return redirect()->action([RollController::class, 'index']);


        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }

    }


    public function edit($id){

  
        $rol = Roll::find($id);

        return view('roles.editar', ['rol'=>$rol]);

    }



    public function update(Request $request) {


        $antes = Roll::find($request->rol_id);


        Validator::make($request->all(), [
            'rol' => 'required|min:5',
        ],
        [
            'rol.required' => 'El rol es requerido.',
            'rol.min' => 'El rol debe tener al menos 5 caracteres.'
        ])->validate();




        if(mb_strtolower($antes->roll)!=mb_strtolower($request->rol)){
            Validator::make($request->all(), [
                'rol' => 'unique:tc_roll,roll',
            ],
            [
                'rol.unique' => 'Este rol ya se existe.',
            ])->validate();

            $antes->hash = Hash::make(Carbon::now()->format('Y-m-d H:i:s'));
            $antes->roll = $request->rol;
        }

        try {

            $antes->save();
            Session::flash('message', ['content' => 'Rol actualizado con éxito', 'type' => 'success']);
            return redirect()->action([RollController::class, 'index']);
        } catch(Exception $ex){



            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3937', 'type' => 'error']);
            return redirect()->back();
        }

    }






    public function delete($id) {
        try {    

            $Roll = Roll::find($id);
            //$Roll->delete();
            $Roll->activo = false;
            $Roll->save();

            Session::flash('message', ['content' => 'Rol eliminado con éxito', 'type' => 'success']);
            return redirect()->action([RollController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function active($id) {
        try {    

            $Roll = Roll::find($id);
            //$Roll->delete();
            $Roll->activo = true;
            $Roll->save();

            Session::flash('message', ['content' => 'Rol activado con éxito', 'type' => 'success']);
            return redirect()->action([RollController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }


}
