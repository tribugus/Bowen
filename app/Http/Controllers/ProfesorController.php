<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\NivelEducativo;
use App\Models\Matricula;
use App\Models\Usuario;
use App\Models\Profesor;
use App\Models\EstadoCivil;
use App\Models\GeneroUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{


    public function index(Request $request){


        $users = Usuario::where('id', '!=',  User('id'))->where('id', '!=', 1)->where('activo', true)->where('roll_id', 4)->get();

        $data = [];

        foreach($users as $key => $value){
            $false = Profesor::where('activo',false)->where('usuario_id',$value->id)->count();
            if($false<1){
                $data[$key] = Usuario::with('profesor')->find($value->id);
            }
        }

        return view('profesor.index',['data' => $data]);



    }





    public function inactivo(Request $request){

        $users = Usuario::where('id', '!=',  User('id'))->where('id', '!=', 1)->where('activo', true)->where('roll_id', 4)->get();
        $data = [];
        foreach($users as $key => $value){

            $false = Profesor::where('activo',false)->where('usuario_id',$value->id)->count();
            if($false==1){
                $data[$key] = Usuario::with('profesor')->find($value->id);
            }

        }


        return view('profesor.inactivo',['data' => $data]);

    }







    public function crear(Request $request){


        $gu = GeneroUsuario::all();
        $ec = EstadoCivil::all();


        return view('profesor.crear',['gu' => $gu, 'ec' => $ec ]);


    }



    public function store(Request $request) {


        Validator::make($request->all(), [
            'nombre' => 'required',
            'ap_pat' => 'required',
            'ap_mat' => 'required',
            'correo' => 'required|email|unique:tw_usuario,correo',
            'telefono' => 'required|min:10|max:10',
            'contrasena' => 'required|min:4|max:7|confirmed',
            'contrasena_confirmation' => 'required|min:4',
            'clave_profesor' => 'required|unique:tw_profesor,clave_profesor',
            'genero' => 'required',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'estado_civil' => 'required',
            'curp' => 'required|unique:tw_profesor,curp',
            'no_seguro_social' => 'required|unique:tw_profesor,no_seguro_social',
            'cedula_fiscal_rfc' => 'required|unique:tw_profesor,cedula_fiscal_rfc',
        ],
        [
            'nombre.required' => 'Los nombres son requeridos.',
            'ap_pat.required' => 'El apellido paterno es requerido.',
            'ap_mat.required' => 'El apellido materno es requerido.',
            'correo.required' => 'El email es un campo requerido.',
            'correo.email' => 'El email debe ser un campo válido.',
            'correo.unique' => 'Este email ya se encuentra en uso.',
            'telefono.required' => 'El teléfono es un campo requerido.',
            'telefono.min' => 'El teléfono es de 10 caracteres.',
            'telefono.max' => 'El teléfono es de 10 caracteres.',
            'contrasena.required' => 'Se requiere una contraseña.',
            'contrasena.min' => 'La contraseña mínima es de 4 caracteres.',
            'contrasena.max' => 'La contraseña máxima es de 7 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas son diferentes.',
            'contrasena_confirmation.required' => 'Se requiere una contraseña.',
            'contrasena_confirmation.min' => 'La contraseña mínima es de 4 caracteres.',
            'clave_profesor.required' => 'La clave del profesor es requerida.',
            'clave_profesor.unique' => 'Esta clave de profesor ya se encuentra en uso.',
            'genero.required' => 'El género es requerido.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida.',
            'lugar_nacimiento.required' => 'El lugar de nacimiento es requerido.',
            'estado_civil.required' => 'El estado civil es requerido.',
            'curp.required' => 'La CURP es requerida.',
            'curp.unique' => 'Esta CURP ya se encuentra en uso.',
            'no_seguro_social.required' => 'El número de seguro social es requerido.',
            'no_seguro_social.unique' => 'Este número de seguro social ya se encuentra en uso.',
            'cedula_fiscal_rfc.required' => 'La cédula fiscal RFC es requerida.',
            'cedula_fiscal_rfc.unique' => 'Esta cédula fiscal RFC ya se encuentra en uso.',
        ])->validate();

              
        $fecha = foFech('/',$request->fecha_nacimiento);
     
        

        try {
            DB::beginTransaction();
        
            $M01 = new Usuario();
            $M01->nombre = $request->nombre;
            $M01->ap_pat = $request->ap_pat;
            $M01->ap_mat = $request->ap_mat;
            $M01->correo = $request->correo;
            $M01->telefono = $request->telefono;
            $M01->roll_id = 4;
            $M01->contrasena = Hash::make($request->contrasena);
            $M01->activo = true;
            $M01->save();
        
            $M02 = new Profesor();
            $M02->usuario_id = $M01->id;
            $M02->clave_profesor = $request->clave_profesor;
            $M02->genero_usuario_id = $request->genero;
            $M02->date = $request->fecha_nacimiento;
            $M02->fecha_nacimiento = $fecha;
            $M02->lugar_nacimiento = $request->lugar_nacimiento;
            $M02->estado_civil_id = $request->estado_civil;
            $M02->curp = $request->curp;
            $M02->no_seguro_social = $request->no_seguro_social;
            $M02->cedula_fiscal_rfc = $request->cedula_fiscal_rfc;
            $M02->activo = true;
            $M02->save();
        
            DB::commit();
        
            Session::flash('message', ['content' => 'Profesor creado con éxito', 'type' => 'success']);
            return redirect()->action([ProfesorController::class, 'index']);
        
        } catch(Exception $ex) {
            DB::rollBack();


            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }
        
        
        

    }




    public function edit($id){


        $model = Usuario::withCount('profesor')->with('profesor')->where('id','!=',User('id'))
                ->where('id','!=',1)->where('activo',true)->where('roll_id',4)
                ->where(function($query) {
                    $query->where('activo', true)->orWhereDoesntHave('profesor');
                })->find($id);

        $gu = GeneroUsuario::all();
        $ec = EstadoCivil::all();


        return view('profesor.editar', compact('model','gu','ec'));



    }



    public function update(Request $request) {


        $antes = Usuario::find($request->usuario_id);

        if($request->profesor_id){
             $antes2 = Profesor::find($request->profesor_id);
        }else{
            $antes2 = new Profesor();
            $antes2->usuario_id = $request->usuario_id;
            $antes2->activo = true;
        }
       



        Validator::make($request->all(), [
            'nombre' => 'required',
            'ap_pat' => 'required',
            'ap_mat' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|min:10|max:10',
            'clave_profesor' => 'required',
            'genero' => 'required',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'estado_civil' => 'required',
            'curp' => 'required',
            'no_seguro_social' => 'required',
            'cedula_fiscal_rfc' => 'required',
        ],
        [
            'nombre.required' => 'Los nombres son requeridos.',
            'ap_pat.required' => 'El apellido paterno es requerido.',
            'ap_mat.required' => 'El apellido materno es requerido.',
            'correo.required' => 'El email es un campo requerido.',
            'correo.email' => 'El email debe ser un campo válido.',
            'telefono.required' => 'El teléfono es un campo requerido.',
            'telefono.min' => 'El teléfono es de 10 caracteres.',
            'telefono.max' => 'El teléfono es de 10 caracteres.',
            'contrasena.required' => 'Se requiere una contraseña.',
            'contrasena.min' => 'La contraseña mínima es de 4 caracteres.',
            'contrasena.max' => 'La contraseña máxima es de 7 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas son diferentes.',
            'contrasena_confirmation.required' => 'Se requiere una contraseña.',
            'contrasena_confirmation.min' => 'La contraseña mínima es de 4 caracteres.',
            'clave_profesor.required' => 'La clave del profesor es requerida.',
            'genero.required' => 'El género es requerido.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida.',
            'lugar_nacimiento.required' => 'El lugar de nacimiento es requerido.',
            'estado_civil.required' => 'El estado civil es requerido.',
            'curp.required' => 'La CURP es requerida.',
            'no_seguro_social.required' => 'El número de seguro social es requerido.',
            'cedula_fiscal_rfc.required' => 'La cédula fiscal RFC es requerida.',
        ])->validate();



        //ANTES
        if(mb_strtolower($antes->correo)!=mb_strtolower($request->correo)){
            Validator::make($request->all(), [
                'correo' => 'unique:tw_usuario,correo',
            ],
            [
                'correo.unique' => 'Este email ya se encuentra en uso.',
            ])->validate();
            $antes->correo= $request->correo;
        }

        if($request->contrasena){
            Validator::make($request->all(), [
                'contrasena' => 'required| min:4| max:7 |confirmed',
                'contrasena_confirmation' => 'required| min:4'
            ],
            [
                'contrasena.required' => 'Se requier una contraseña.',
                'contrasena.min' => 'La contraseña minima es de 4 caracteres.',
                'contrasena.max' => 'La contraseña maxima es de 7 caracteres.',
                'contrasena.confirmed' => 'Las contraseñas son diferentes.',
                'contrasena_confirmation.required' => 'Se requier una contraseña.',
                'contrasena_confirmation.min' => 'La contraseña minima es de 4 caracteres.',
            ])->validate();
            $antes->contrasena = Hash::make($request->contrasena);
        }
        $antes->nombre= $request->nombre;
        $antes->ap_pat= $request->ap_pat;
        $antes->ap_mat= $request->ap_mat;
        $antes->ap_mat= $request->ap_mat;
        $antes->telefono= $request->telefono;
        $antes->roll_id= 4;



        //ANTES2
        if(mb_strtolower($antes2->clave_profesor)!=mb_strtolower($request->clave_profesor)){
            Validator::make($request->all(), [
                'clave_profesor' => 'unique:tw_profesor,clave_profesor',
            ],
            [
                'clave_profesor.unique' => 'Esta clave de profesor ya se encuentra en uso.',
            ])->validate();
            $antes2->clave_profesor = $request->clave_profesor;
        }
        
        if(mb_strtolower($antes2->curp)!=mb_strtolower($request->curp)){
            Validator::make($request->all(), [
                'curp' => 'unique:tw_profesor,curp',
            ],
            [
                'curp.unique' => 'Esta CURP ya se encuentra en uso.',
            ])->validate();
            $antes2->curp = $request->curp;
        }
 
        if(mb_strtolower($antes2->no_seguro_social)!=mb_strtolower($request->no_seguro_social)){
            Validator::make($request->all(), [
                'no_seguro_social' => 'unique:tw_profesor,no_seguro_social',
            ],
            [
                'no_seguro_social.unique' => 'Este número de seguro social ya se encuentra en uso.',
            ])->validate();
            $antes2->no_seguro_social = $request->no_seguro_social; 
        }
  
        if(mb_strtolower($antes2->cedula_fiscal_rfc)!=mb_strtolower($request->cedula_fiscal_rfc)){
            Validator::make($request->all(), [
                'cedula_fiscal_rfc' => 'unique:tw_profesor,cedula_fiscal_rfc',
            ],
            [
                'cedula_fiscal_rfc.unique' => 'Esta cédula fiscal RFC ya se encuentra en uso.',
            ])->validate();
            $antes2->cedula_fiscal_rfc = $request->cedula_fiscal_rfc; 
        }

        $fecha = foFech('/',$request->fecha_nacimiento);

        $antes2->clave_profesor = $request->clave_profesor;
        $antes2->genero_usuario_id = $request->genero;
        $antes2->date = $request->fecha_nacimiento;
        $antes2->fecha_nacimiento = $fecha;
        $antes2->lugar_nacimiento = $request->lugar_nacimiento;
        $antes2->estado_civil_id = $request->estado_civil;
        $antes2->curp = $request->curp;
        $antes2->no_seguro_social = $request->no_seguro_social;
        $antes2->cedula_fiscal_rfc = $request->cedula_fiscal_rfc;
     
        

        try {
            DB::beginTransaction();
    
            $antes->save();
            $antes2->save();
        
            DB::commit();
        
            Session::flash('message', ['content' => 'Profesor creado con éxito', 'type' => 'success']);
            return redirect()->action([ProfesorController::class, 'index']);
        
        } catch(Exception $ex) {
            DB::rollBack();

        
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }
        


    }



    public function delete($id) {
        try {    

            $model = Profesor::where('usuario_id', $id)->first();

            if($model){

                $model->activo = false;
                $model->save();
            }else{

                $fecha = Carbon::now();

                $M01 = new Profesor();
                $M01->usuario_id = $id;
                $M01->clave_profesor = '⨯';
                $M01->genero_usuario_id = 0;
                $M01->date = '';
                $M01->fecha_nacimiento = $fecha->format('Y-m-d');
                $M01->lugar_nacimiento = '⨯';
                $M01->estado_civil_id = 0;
                $M01->curp = '⨯';
                $M01->no_seguro_social = '⨯';
                $M01->cedula_fiscal_rfc = '⨯';
                $M01->activo = false;
                $M01->save();

            }

            Session::flash('message', ['content' => 'Profesor eliminado con éxito', 'type' => 'success']);
            return redirect()->action([ProfesorController::class, 'index']);
        }catch(Exception $ex){

            return $ex;
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }




    public function active($id) {
        try {    

    
            $model = Profesor::where('usuario_id', $id)->first();

            $model->activo = true;
            $model->save();

            Session::flash('message', ['content' => 'Profesor activado con éxito', 'type' => 'success']);
            return redirect()->action([ProfesorController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }




}
