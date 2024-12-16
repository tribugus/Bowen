<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\NivelEducativo;
use App\Models\Matricula;
use App\Models\CicloEscolar;
use App\Models\GeneroUsuario;
use App\Models\Usuario;
use App\Models\Estado;
use App\Models\Nacionalidad;
use App\Models\Profesor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
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

        return view('alumno.index',['data' => $data]);



    }



    public function crear(Request $request){



        $nv_edu = NivelEducativo::where('activo',true)->get();

        foreach($nv_edu as $k => $v){
            $arg = [];
            for ($i=0; $i < $v->grado_fin; $i++) { 
                $arg[] = $i+1;
            }
            $nv_edu[$k]->grados = $arg;
        }


        $ciclo = CicloEscolar::where('activo',true)->get();
        $gu = GeneroUsuario::all();

        $nacionalidades = Nacionalidad::all();


        $estados = Estado::all();


        return view('alumno.crear',[
            'nv_edu' => $nv_edu,
            'nacionalidades' => $nacionalidades,
            'ciclo' => $ciclo,
            'gu' => $gu,
            'estados' => $estados,
        ]);


    }





    public function store(Request $request) {


        Validator::make($request->all(), [
            'nivel_educativo_id' => 'required',
            'nacionalidad_id' => 'required',
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
            'fecha_ingreso' => 'required',
        ],
        [
            'nivel_educativo_id.required' => 'Nivel educativo es requerido.',
            'nacionalidad_id.required' => 'La nacionalidad es requerida.',
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
            'fecha_ingreso.required' => 'La fecha de ingreso es requerida.',
        ])->validate();



        

    }












}
