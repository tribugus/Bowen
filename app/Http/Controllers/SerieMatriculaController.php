<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\Matricula;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SerieMatriculaController extends Controller
{


    public function index(Request $request){


        $data = Matricula::where('activo',true)->get();

        return view('serie_matricula.index',['data' => $data]);



    }



    public function crear(Request $request){


        return view('serie_matricula.crear');

    }




    public function store(Request $request) {



        // Definir los patrones permitidos (los patrones válidos)
        $validPatterns = '\[nnnnn\]|\[aaaa\]|\[aa\]|\[ii\]|\[iiii\]|\[ffff\]|\[cc\]|\[ggggg\]|\[p\]|\[m\]|\[plan\]|\[\?+\]';
    

        Validator::make($request->all(), [


            'formato' => [
                'unique:tc_matricula,formato',  
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request,$validPatterns) {
                    // Convertir la cadena a minúsculas
                    $value = strtolower(trim($value));
    
                    // Definir los patrones para los 2 y 4 caracteres
                    $patterns = [
                        'nnnnn' => '\[nnnnn\]', 
                        'aaaa' => '\[aaaa\]',   
                        'aa'   => '\[aa\]',     
                        'ii'   => '\[ii\]',     
                        'iiii' => '\[iiii\]',   
                        'ffff' => '\[ffff\]',   
                        'cc'   => '\[cc\]',     
                        'ggggg'=> '\[ggggg\]',  
                        'p'    => '\[p\]',      
                        'm'    => '\[m\]',      
                        'plan' => '\[plan\]',   
                    ];
                    //Array para almacenar las coincidencias encontradas
                    $matches = [];
    
                    // Verificar cada patrón en la cadena
                    foreach ($patterns as $key => $pattern) {
                        preg_match_all('/' . $pattern . '/', $value, $matches[$key]);
                    }
    
                    // Verificar que no haya repeticiones de los patrones
                    foreach ($matches as $key => $match) {
                        if (count($match[0]) > 1) {
                            $fail('El patrón [' . $key . '] no puede repetirse más de una vez.');
                            return;
                        }
                    }
    

                    // Validación de que la cadena contenga solo los patrones válidos y que no haya patrones no válidos
                    // Verificar patrones no válidos, como [AAA], [invalid], etc.
                    preg_match_all('/\[[^\]]+\]/', $value, $matches);  // Buscar todos los patrones en la cadena

                    foreach ($matches[0] as $match) {
                        // Si el patrón no coincide con los patrones permitidos
                        if (!preg_match('/^' . $validPatterns . '$/', $match)) {
                            $fail("El patrón '{$match}' no es válido.");
                            return;
                        }
                    }


                    // Verificar que no haya combinación de [aa][aaaa] o [ii][iiii] más de una vez
                    $aa_2_chars = preg_match_all('/\[aa\]/', $value);  // Para 2 caracteres de aa
                    $aaaa_4_chars = preg_match_all('/\[aaaa\]/', $value);  // Para 4 caracteres de aaaa
                    $ii_2_chars = preg_match_all('/\[ii\]/', $value);  // Para 2 caracteres de ii
                    $iiii_4_chars = preg_match_all('/\[iiii\]/', $value);  // Para 4 caracteres de iiii
    
                    // Verificar que no aparezcan combinaciones inválidas
                    if (($aa_2_chars > 0 && $aaaa_4_chars > 0) || $aa_2_chars > 1 || $aaaa_4_chars > 1) {
                        $fail('No puede haber más de un patrón [aa] y [aaaa] al mismo tiempo.');
                        return;
                    }
    
                    if (($ii_2_chars > 0 && $iiii_4_chars > 0) || $ii_2_chars > 1 || $iiii_4_chars > 1) {
                        $fail('No puede haber más de un patrón [ii] y [iiii] al mismo tiempo.');
                        return;
                    }
                    if(preg_match('/\[\s*\]/', $value)) {
                        $fail('No se permite corchetes vacíos, ni con espacios, en el formato (por ejemplo, [ ]).');
                        return;
                    }
                    // **Validación extra**: Verificar que haya al menos un carácter adicional que no sea patrón o corchete vacío
                    // Eliminar todos los patrones y los corchetes vacíos
                    $valueWithoutPatterns = preg_replace('/\[[^\]]*\]/', '', $value); // Eliminar todos los patrones y sus corchetes
                    // Verificar si la cadena sin patrones sigue teniendo algún carácter
                    if (trim($valueWithoutPatterns) == '') {
                        $fail('El formato debe contener al menos un carácter adicional que no sea un patrón.');
                    }

                    preg_match_all('/\[\?+\]/', $value, $matches);

                    // Verificar que no se exceda el número de signos de interrogación
                    foreach ($matches[0] as $match) {
                        // Contar la cantidad de signos de interrogación
                        $count = substr_count($match, '?');
                        if ($count < strlen($request->limite_matricula)) {
                            $fail('Los signos interrogación deben ser iguales o mayores al limite de matrícula');
                            return;
                        }
                    }

                }
            ],


            'consecutivo_matricula' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    // Comprobar que consecutivo_matricula no sea mayor que limite_matricula
                    if ($value > $request->limite_matricula) {
                        $fail('Concecutivo de matrícula no puede ser mayor que limte para matrículas');
                    }
                },
            ],
            'limite_matricula' => [
                'required',
                'integer',
                'min:100',
                function ($attribute, $value, $fail) use ($request) {
                    // Comprobar que limite_matricula no sea menor que consecutivo_matricula
                    if ($value < $request->consecutivo_matricula) {
                        $fail('El limte para matrículas no puede ser menor que el valor de concecutivo de matrícula');
                    }
                },
            ],
        ], [

 
            'formato.required' => 'El campo formato es obligatorio.',
            'formato.string' => 'El campo formato debe ser una cadena de texto válida.',
            'formato.unique' => 'El formato ya existe.',

            'consecutivo_matricula.required' => 'Concecutivo de matrícula es obligatorio',
            'consecutivo_matricula.integer' => 'Concecutivo de matrícula debe ser un número entero',
            'consecutivo_matricula.min' => 'Concecutivo de matrícula debe ser al menos 1',
            
            'limite_matricula.required' => 'Limte para matrículas es obligatorio.',
            'limite_matricula.integer' => 'Limte para matrículas debe ser un número entero',
            'limite_matricula.min' => 'Limte para matrículas debe ser al menos 100',
        ])->validate();


        try {
            $model = new Matricula();
            $model->formato = str_replace(' ', '', mb_strtolower($request->formato));
            $model->ini_matricula = $request->consecutivo_matricula;
            $model->consecutivo_matricula = $request->consecutivo_matricula;
            $model->limite_matricula = $request->limite_matricula;
            if($request->permitir_modificar){
                $model->permitir_modificar = true;
            }else{
                $model->permitir_modificar = false;
            }
            $model->activo = true;
            $model->save();
            Session::flash('message', ['content' => 'Ciclo escolar creado con éxito', 'type' => 'success']);
            return redirect()->action([SerieMatriculaController::class, 'index']);
        } catch(Exception $ex){
            return $ex;
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3924', 'type' => 'error']);
            return redirect()->back();
        }

    }


    public function edit($id){

  
        $model = Matricula::find($id);

        return view('serie_matricula.editar', ['model'=>$model]);

    }



    public function update(Request $request) {



        $antes = Matricula::find($request->id);
        $validPatterns = '\[nnnnn\]|\[aaaa\]|\[aa\]|\[ii\]|\[iiii\]|\[ffff\]|\[cc\]|\[ggggg\]|\[p\]|\[m\]|\[plan\]|\[\?+\]';
        Validator::make($request->all(), [
            'formato' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request,$validPatterns) {
                    $value = strtolower(trim($value));
                    $patterns = [
                        'nnnnn' => '\[nnnnn\]', 
                        'aaaa' => '\[aaaa\]',   
                        'aa'   => '\[aa\]',     
                        'ii'   => '\[ii\]',     
                        'iiii' => '\[iiii\]',   
                        'ffff' => '\[ffff\]',   
                        'cc'   => '\[cc\]',     
                        'ggggg'=> '\[ggggg\]',  
                        'p'    => '\[p\]',      
                        'm'    => '\[m\]',      
                        'plan' => '\[plan\]',   
                    ];
                    $matches = [];
                    foreach ($patterns as $key => $pattern) {
                        preg_match_all('/' . $pattern . '/', $value, $matches[$key]);
                    }
                    foreach ($matches as $key => $match) {
                        if (count($match[0]) > 1) {
                            $fail('El patrón [' . $key . '] no puede repetirse más de una vez.');
                            return;
                        }
                    }
                    preg_match_all('/\[[^\]]+\]/', $value, $matches);
                    foreach ($matches[0] as $match) {
                        if (!preg_match('/^' . $validPatterns . '$/', $match)) {
                            $fail("El patrón '{$match}' no es válido.");
                            return;
                        }
                    }
                    $aa_2_chars = preg_match_all('/\[aa\]/', $value);
                    $aaaa_4_chars = preg_match_all('/\[aaaa\]/', $value);
                    $ii_2_chars = preg_match_all('/\[ii\]/', $value);
                    $iiii_4_chars = preg_match_all('/\[iiii\]/', $value);
    
                    // Verificar que no aparezcan combinaciones inválidas
                    if (($aa_2_chars > 0 && $aaaa_4_chars > 0) || $aa_2_chars > 1 || $aaaa_4_chars > 1) {
                        $fail('No puede haber más de un patrón [aa] y [aaaa] al mismo tiempo.');
                        return;
                    }
    
                    if (($ii_2_chars > 0 && $iiii_4_chars > 0) || $ii_2_chars > 1 || $iiii_4_chars > 1) {
                        $fail('No puede haber más de un patrón [ii] y [iiii] al mismo tiempo.');
                        return;
                    }
                    if(preg_match('/\[\s*\]/', $value)) {
                        $fail('No se permite corchetes vacíos, ni con espacios, en el formato (por ejemplo, [ ]).');
                        return;
                    }
                    $valueWithoutPatterns = preg_replace('/\[[^\]]*\]/', '', $value);
                    if (trim($valueWithoutPatterns) == '') {
                        $fail('El formato debe contener al menos un carácter adicional que no sea un patrón.');
                    }
                    preg_match_all('/\[\?+\]/', $value, $matches);
                    foreach ($matches[0] as $match) {
                        $count = substr_count($match, '?');
                        if ($count < strlen($request->limite_matricula)) {
                            $fail('Los signos interrogación deben ser iguales o mayores al limite de matrícula');
                            return;
                        }
                    }

                }
            ],
            'consecutivo_matricula' => [
                'required',
                'integer',
                'min:'.$antes->consecutivo_matricula,
                function ($attribute, $value, $fail) use ($request) {
                    if ($value > $request->limite_matricula) {
                        $fail('Concecutivo de matrícula no puede ser mayor que limte para matrículas');
                    }
                },
            ],
            'limite_matricula' => [
                'required',
                'integer',
                'min:100',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->consecutivo_matricula) {
                        $fail('El limte para matrículas no puede ser menor que el valor de concecutivo de matrícula');
                    }
                },
            ],
        ], [
            'formato.required' => 'El campo formato es obligatorio.',
            'formato.string' => 'El campo formato debe ser una cadena de texto válida.',
            'consecutivo_matricula.required' => 'Concecutivo de matrícula es obligatorio',
            'consecutivo_matricula.integer' => 'Concecutivo de matrícula debe ser un número entero',
            'consecutivo_matricula.min' => 'Concecutivo de matrícula debe ser mayor a '.$antes->consecutivo_matricula,
            'limite_matricula.required' => 'Limte para matrículas es obligatorio.',
            'limite_matricula.integer' => 'Limte para matrículas debe ser un número entero',
            'limite_matricula.min' => 'Limte para matrículas debe ser al menos 100',
        ])->validate();



        if($antes->formato!=$request->formato){
            Validator::make($request->all(), [
                'formato' => 'unique:tc_matricula,formato',
            ],
            [
                'formato.unique' => 'Este formato ya existe.',
            ])->validate();
            $antes->formato = $request->formato;
        }



        try {
            
            $antes->formato = str_replace(' ', '', mb_strtolower($request->formato));
            $antes->consecutivo_matricula = $request->consecutivo_matricula;
            $antes->limite_matricula = $request->limite_matricula;
            if($request->permitir_modificar){
                $antes->permitir_modificar = true;
            }else{
                $antes->permitir_modificar = false;
            }

            $antes->save();

            Session::flash('message', ['content' => 'Formato actualizado con éxito', 'type' => 'success']);
            return redirect()->action([SerieMatriculaController::class, 'index']);

        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3937', 'type' => 'error']);
            return redirect()->back();
        }

    }






    public function delete($id) {
        try {    

            $model = Matricula::find($id);
            $model->activo = false;
            $model->save();

            Session::flash('message', ['content' => 'Formato eliminado con éxito', 'type' => 'success']);
            return redirect()->action([SerieMatriculaController::class, 'index']);

        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }



    public function inactivo(Request $request){

        $data = Matricula::where('activo',false)->get();
        return view('serie_matricula.inactivo',['data' => $data]);
    }



    public function active($id) {
        try {    

            $model = Matricula::find($id);
            $model->activo = true;
            $model->save();

            Session::flash('message', ['content' => 'Formato activado con éxito', 'type' => 'success']);
            return redirect()->action([SerieMatriculaController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }




}
