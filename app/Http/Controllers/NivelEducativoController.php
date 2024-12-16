<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\NivelEducativo;
use App\Models\Matricula;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NivelEducativoController extends Controller
{


    public function index(Request $request){


        $data = NivelEducativo::with('director')->where('activo',true)->get();

        return view('nivel_educativo.index',['data' => $data]);



    }



    public function crear(Request $request){

        $dir = Usuario::withCount('roll')->with('roll')->where('id','!=',User('id'))->where('id','!=',1)->where('activo',true)
                      ->whereHas('roll', function ($query) {
                          $query->where('id', 3);
                      })->get();

        $mat = Matricula::where('activo',true)->doesntHave('nivel_educativo')->get();

        return view('nivel_educativo.crear',['dir' => $dir,'mat' => $mat]);

    }







    public function store(Request $request) {


        Validator::make($request->all(), [
            'clave_identificador' => 'required|unique:tc_nivel_educativo,clave_identificador',
            'descripcion_nivel' => 'required|unique:tc_nivel_educativo,descripcion',
            'acuerdo_creacion_incorporacion' => 'required',
            'director_usuario_id' => 'required',
            'denominacion_grado' => 'required',
            'matricula_id' => 'required|unique:tc_nivel_educativo,matricula_id',
            'fecha_incorporacion' => 'required',
            'zona_escolar' => 'required',
            'grado_ini' => 'required|integer|min:1|lte:grado_fin',
            'grado_fin' => 'required|integer|min:1|gte:grado_ini',  

        ], [
            'clave_identificador.required' => 'Clave o identificador requerido.',
            'clave_identificador.unique' => 'Clave o identificador ya registrado.',
            'descripcion_nivel.required' => 'Descripción requerida.',
            'descripcion_nivel.unique' => 'Descripción ya registrada.',
            'acuerdo_creacion_incorporacion.required' => 'Acuerdo de creación requerido.',
            'director_usuario_id.required' => 'Selección de director requerido.',
            'denominacion_grado.required' => 'Denominación de grado requerido.',
            'matricula_id.required' => 'Selección de matrícula requerido.',
            'matricula_id.unique' => 'Matrícula en uso.',
            'fecha_incorporacion.required' => 'La fecha de incorporacón es requerida.',
            'zona_escolar.required' => 'La zona escolar es requerida.',
            'grado_ini.required' => 'El grado de inicio es requerido.',
            'grado_ini.integer' => 'El grado de inicio debe ser un número entero.',
            'grado_ini.min' => 'El grado de inicio no puede ser menor que 1.',
            'grado_ini.lte' => 'El grado de inicio no puede ser mayor que el grado de fin.',
            'grado_fin.required' => 'El grado de fin es requerido.',
            'grado_fin.integer' => 'El grado de fin debe ser un número entero.',
            'grado_fin.min' => 'El grado de fin no puede ser menor que 1.',
            'grado_fin.gte' => 'El grado de fin no puede ser menor que el grado de inicio.',
    
        ])->validate();


  
        $fecha = foFech('/',$request->fecha_incorporacion);
 


        try {


            $model = new NivelEducativo();
            $model->clave_identificador = $request->clave_identificador;
            $model->descripcion = $request->descripcion_nivel;
            $model->director_usuario_id = $request->director_usuario_id;
            $model->acuerdo_creacion_incorporacion = $request->acuerdo_creacion_incorporacion;
            $model->denominacion_grado = $request->denominacion_grado;
            $model->matricula_id = $request->matricula_id;
            $model->date = $request->fecha_incorporacion;
            $model->fecha_incorporacion = $fecha;
            $model->zona_escolar = $request->zona_escolar;
            $model->grado_ini = $request->grado_ini;
            $model->grado_fin = $request->grado_fin;
            $model->activo = true;
            $model->save();
            Session::flash('message', ['content' => 'Nivel educativo creado con éxito', 'type' => 'success']);
            return redirect()->action([NivelEducativoController::class, 'index']);


        } catch(Exception $ex){

            return $ex;


            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 455977', 'type' => 'error']);
            return redirect()->back();
        }

    }






    public function edit($id){

  
        $dir =  Usuario::withCount('roll')->with('roll')->where('id','!=',User('id'))->where('id','!=',1)->where('activo',true)
                ->whereHas('roll', function ($query) {
                    $query->where('id', 3);
                })->get();

        $mat = Matricula::where('activo',true)->doesntHave('nivel_educativo')->get();

        $model = NivelEducativo::with('matricula')->where('activo',true)->find($id);


        return view('nivel_educativo.editar', ['model'=>$model,'dir'=>$dir,'mat'=>$mat]);

    }






    public function update(Request $request) {



        $antes = NivelEducativo::find($request->id);


        Validator::make($request->all(), [
            'clave_identificador' => 'required',
            'descripcion_nivel' => 'required',
            'acuerdo_creacion_incorporacion' => 'required',
            'director_usuario_id' => 'required',
            'denominacion_grado' => 'required',
            'matricula_id' => 'required',
            'fecha_incorporacion' => 'required',
            'zona_escolar' => 'required',
            'grado_ini' => 'required|integer|min:1|lte:grado_fin',
            'grado_fin' => 'required|integer|min:1|gte:grado_ini',  

        ], [
            'clave_identificador.required' => 'Clave o identificador requerido.',
            'descripcion_nivel.required' => 'Descripción requerida.',
            'acuerdo_creacion_incorporacion.required' => 'Acuerdo de creación requerido.',
            'director_usuario_id.required' => 'Selección de director requerido.',
            'denominacion_grado.required' => 'Denominación de grado requerido.',
            'matricula_id.required' => 'Selección de matrícula requerido.',
            'fecha_incorporacion.required' => 'La fecha de incorporacón es requerida.',
            'zona_escolar.required' => 'La zona escolar es requerida.',
            'grado_ini.required' => 'El grado de inicio es requerido.',
            'grado_ini.integer' => 'El grado de inicio debe ser un número entero.',
            'grado_ini.min' => 'El grado de inicio no puede ser menor que 1.',
            'grado_ini.lte' => 'El grado de inicio no puede ser mayor que el grado de fin.',
            'grado_fin.required' => 'El grado de fin es requerido.',
            'grado_fin.integer' => 'El grado de fin debe ser un número entero.',
            'grado_fin.min' => 'El grado de fin no puede ser menor que 1.',
            'grado_fin.gte' => 'El grado de fin no puede ser menor que el grado de inicio.',
    
        ])->validate();



        if($antes->clave_identificador!=$request->clave_identificador){
            Validator::make($request->all(), [
                'clave_identificador' => 'unique:tc_nivel_educativo,clave_identificador',
            ],
            [
                'clave_identificador.unique' => 'Clave o identificador ya registrado.',
            ])->validate();
            $antes->clave_identificador = $request->clave_identificador;
        }


        if($antes->descripcion!=$request->descripcion_nivel){
            Validator::make($request->all(), [
                'descripcion_nivel' => 'unique:tc_nivel_educativo,descripcion',
            ],
            [
                'descripcion_nivel.unique' => 'Descripción ya registrada.',
            ])->validate();
            $antes->descripcion_nivel = $request->descripcion_nivel;
        }


        if($antes->matricula_id!=$request->matricula_id){
            Validator::make($request->all(), [
                'matricula_id' => 'unique:tc_nivel_educativo,matricula_id',
            ],
            [
                'matricula_id.unique' => 'Matrícula en uso.',
            ])->validate();
            $antes->matricula_id = $request->matricula_id;
        }


        $fecha = foFech('/',$request->fecha_incorporacion);
 


        try {


            $antes->director_usuario_id = $request->director_usuario_id;
            $antes->acuerdo_creacion_incorporacion = $request->acuerdo_creacion_incorporacion;
            $antes->denominacion_grado = $request->denominacion_grado;
            $antes->date = $request->fecha_incorporacion;
            $antes->fecha_incorporacion = $fecha;
            $antes->zona_escolar = $request->zona_escolar;
            $antes->grado_ini = $request->grado_ini;
            $antes->grado_fin = $request->grado_fin;
            $antes->activo = true;
            $antes->save();
            Session::flash('message', ['content' => 'Nivel educativo actualizado con éxito', 'type' => 'success']);
            return redirect()->action([NivelEducativoController::class, 'index']);

        } catch(Exception $ex){


            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 455977', 'type' => 'error']);
            return redirect()->back();
        }



    }



    public function delete($id) {
        try {    

            $model = NivelEducativo::find($id);
            $model->activo = false;
            $model->save();

            Session::flash('message', ['content' => 'Nivel educativo eliminado con éxito', 'type' => 'success']);
            return redirect()->action([NivelEducativoController::class, 'index']);

        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 355654', 'type' => 'error']);
            return redirect()->back();
        }
    }




    public function inactivo(Request $request){

        $data = NivelEducativo::with('director')->where('activo',false)->get();
        return view('nivel_educativo.inactivo',['data' => $data]);

    }

    public function active($id) {
        try {    

            $model = NivelEducativo::find($id);
            $model->activo = true;
            $model->save();

            Session::flash('message', ['content' => 'Nivel educativo activado con éxito', 'type' => 'success']);
            return redirect()->action([NivelEducativoController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }







}
