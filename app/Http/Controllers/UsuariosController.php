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

class UsuariosController extends Controller
{


    public function index(Request $request){

        $data = Usuario::with('roll')->where('id','!=',User('id'))->where('id','!=',1)->where('activo',true)->get();
        return view('usuarios.index',['data' => $data]);

    }

    public function inactivo(Request $request){

        $data = Usuario::with('roll')->where('id','!=',User('id'))->where('id','!=',1)->where('activo',false)->get();
        return view('usuarios.inactivo',['data' => $data]);

    }

    public function crear(Request $request){

        $roles = Roll::where('activo',true)->where('id','!=',1)->get();
        return view('usuarios.crear', ['roles' => $roles]);

    }




    public function store(Request $request) {




        Validator::make($request->all(), [
            'nombre' => 'required',
            'ap_pat' => 'required',
            'ap_mat' => 'required',
            'correo' => 'required|email|unique:tw_usuario,correo',
            'telefono' => 'required|min:10|max:10',
            'roll_id' => 'required',
            'contrasena' => 'required| min:4| max:7 |confirmed',
            'contrasena_confirmation' => 'required| min:4'
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
            'roll_id.required' => 'Seleccione el roll de el usuario.',
            'contrasena.required' => 'Se requier una contraseña.',
            'contrasena.min' => 'La contraseña minima es de 4 caracteres.',
            'contrasena.max' => 'La contraseña maxima es de 7 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas son diferentes.',
            'contrasena_confirmation.required' => 'Se requier una contraseña.',
            'contrasena_confirmation.min' => 'La contraseña minima es de 4 caracteres.',

        ])->validate();


        try {

            $user = new Usuario();
            $user->nombre = $request->nombre;
            $user->ap_pat = $request->ap_pat;
            $user->ap_mat = $request->ap_mat;
            $user->correo = $request->correo;
            $user->telefono = $request->telefono;
            $user->roll_id = $request->roll_id;
            $user->contrasena = Hash::make($request->contrasena);
            $user->activo = true;
            $user->save();

            Session::flash('message', ['content' => 'Usuario creado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);


        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }

    }


    public function edit($id){

  
    
        $roles = Roll::where('activo',true)->where('id','!=',1)->get();
        $user = Usuario::find($id);

        return view('usuarios.editar', ['roles' => $roles,'user'=>$user]);

    }



    public function update(Request $request) {


        $antes = Usuario::find($request->usuario_id);


        Validator::make($request->all(), [
            'correo' => 'required|email',
            'nombre' => 'required',
            'ap_pat' => 'required',
            'ap_mat' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|min:10|max:10',
            'roll_id' => 'required',
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
            'roll_id.required' => 'Seleccione el roll de el usuario.',
            'correo.required' => 'El email es un campo requerido.',
            'correo.email' => 'El email debe ser un campo válido.',

        ])->validate();



        if($antes->correo!=$request->correo){
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
        $antes->roll_id= $request->roll_id;


        try {

            $antes->save();
            Session::flash('message', ['content' => 'Usuario actualizado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);
        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }

    }






    public function delete($id) {
        try {    

            $User = Usuario::find($id);
            $User->activo = false;
            $User->save();

            Session::flash('message', ['content' => 'Usuario eliminado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }


    public function active($id) {
        try {    

            $User = Usuario::find($id);
            $User->activo = true;
            $User->save();

            Session::flash('message', ['content' => 'Usuario activado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }


}
