<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\CicloEscolar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CicloEscolarController extends Controller
{


    public function index(Request $request){

        $data = CicloEscolar::where('activo',true)->get();


        return view('cicloescolar.index',['data' => $data]);



    }



    public function crear(Request $request){


        return view('cicloescolar.crear');

    }




    public function store(Request $request) {


        Validator::make($request->all(), [
            'ano_ini' => [
                'required',
                'integer',
                'min:' . Carbon::now()->year - 1000,
                'max:' . (Carbon::now()->year + 100),
                function ($attribute, $value, $fail) use ($request) {
                    // Validar que ano_ini no sea mayor a ano_fin
                    if ($value > $request->ano_fin) {
                        $fail('El año inicial no puede ser mayor al año final.');
                    }
                }
            ],
            'ano_fin' => [
                'required',
                'integer',
                'min:' . Carbon::now()->year - 1000,
                'max:' . (Carbon::now()->year + 100),
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->ano_ini) {
                        $fail('El año final no puede ser menor al año inicial.');
                    }
                }
            ],
            'periodo' => 'required',
            'descripcion' => 'required',
            'abreviatura' => 'required',
            'denominacion' => 'required',
            'codigo' => 'required',
            'date_ini' => 'required',
            'date_fin' => 'required',
        ], [
            'date_ini.required' => 'El mes y día inicial es requerido.',
            'date_fin.required' => 'El mes y día final es requerido.',
            'codigo.required' => 'El código es requerido.',
            'ano_ini.required' => 'El año inicial es requerido.',
            'ano_ini.min' => 'El año inicial no puede ser menor al año actual.',
            'ano_ini.max' => 'El año inicial no puede ser mayor a tres años del año actual.',
            
            'ano_fin.required' => 'El año final es requerido.',
            'ano_fin.min' => 'El año final no puede ser menor al año actual.',
            'ano_fin.max' => 'El año final no puede ser mayor a tres años del año actual.',
            
            'periodo.required' => 'El periodo es requerido.',
            'descripcion.required' => 'La descripción es requerida.',
            'abreviatura.required' => 'La abreviatura es requerida.',
            'denominacion.required' => 'La denominación es requerida.',
            'ano_ini' => [
                'required' => 'El año inicial es obligatorio.',
                'min' => 'El año inicial no puede ser menor al año actual.',
                'max' => 'El año inicial no puede ser mayor a tres años del año actual.',
            ],
            'ano_fin' => [
                'required' => 'El año final es obligatorio.',
                'min' => 'El año final no puede ser menor al año actual.',
                'max' => 'El año final no puede ser mayor a tres años del año actual.',
            ],
        ])
        ->after(function ($validator) use ($request) {
            $exists = DB::table('tc_ciclo_escolar')
                ->where('ano_ini', $request->ano_ini)
                ->where('ano_fin', $request->ano_fin)
                ->where('periodo', $request->periodo)
                ->where('descripcion', $request->descripcion)
                ->where('abreviatura', $request->abreviatura)
                ->where('denominacion', $request->denominacion)
                ->where('date_ini', $request->date_ini)
                ->where('date_fin', $request->date_fin)
                ->exists();
        
            if ($exists) {
                $validator->errors()->add('duplicado', 'Ya existe un ciclo escolar con la misma combinación de valores.');
            }
        })->validate();



        $fechaIni = $request->ano_ini."-".foFech('/',$request->date_ini);
        $fechaFin = $request->ano_fin."-".foFech('/',$request->date_fin);

  

        try {

            $model = new CicloEscolar();
            $model->ano_ini = $request->ano_ini;
            $model->ano_fin = $request->ano_fin;
            $model->periodo = $request->periodo;
            $model->descripcion = $request->descripcion;
            $model->abreviatura = $request->abreviatura;
            $model->denominacion = $request->denominacion;
            $model->codigo = $request->codigo;
            $model->date_ini = $request->date_ini;
            $model->date_fin = $request->date_fin;
            $model->fecha_ini = $fechaIni;
            $model->fecha_fin = $fechaFin;
            $model->activo = true;
            $model->save();



            Session::flash('message', ['content' => 'Ciclo escolar creado con éxito', 'type' => 'success']);
            return redirect()->action([CicloEscolarController::class, 'index']);


        } catch(Exception $ex){

            return $ex;

    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3977', 'type' => 'error']);
            return redirect()->back();
        }

    }


    public function edit($id){

  
        $model = CicloEscolar::find($id);

        return view('cicloescolar.editar', ['cic'=>$model]);

    }



    public function update(Request $request) {

        $antes = CicloEscolar::find($request->id);

        Validator::make($request->all(), [
            'ano_ini' => [
                'required',
                'integer',
                'min:' . Carbon::now()->year,
                'max:' . (Carbon::now()->year + 10),
                function ($attribute, $value, $fail) use ($request) {
                    // Validar que ano_ini no sea mayor a ano_fin
                    if ($value > $request->ano_fin) {
                        $fail('El año inicial no puede ser mayor al año final.');
                    }
                }
            ],
            'ano_fin' => [
                'required',
                'integer',
                'min:' . Carbon::now()->year,
                'max:' . (Carbon::now()->year + 10),
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->ano_ini) {
                        $fail('El año final no puede ser menor al año inicial.');
                    }
                }
            ],
            'periodo' => 'required',
            'descripcion' => 'required',
            'abreviatura' => 'required',
            'denominacion' => 'required',
            'codigo' => 'required',
            'date_ini' => 'required',
            'date_fin' => 'required',
        ], [
            'date_ini.required' => 'El mes y día inicial es requerido.',
            'date_fin.required' => 'El mes y día final es requerido.',
            'codigo.required' => 'El código es requerido.',
            'ano_ini.required' => 'El año inicial es requerido.',
            'ano_ini.min' => 'El año inicial no puede ser menor al año actual.',
            'ano_ini.max' => 'El año inicial no puede ser mayor a tres años del año actual.',
            
            'ano_fin.required' => 'El año final es requerido.',
            'ano_fin.min' => 'El año final no puede ser menor al año actual.',
            'ano_fin.max' => 'El año final no puede ser mayor a tres años del año actual.',
            
            'periodo.required' => 'El periodo es requerido.',
            'descripcion.required' => 'La descripción es requerida.',
            'abreviatura.required' => 'La abreviatura es requerida.',
            'denominacion.required' => 'La denominación es requerida.',
            'ano_ini' => [
                'required' => 'El año inicial es obligatorio.',
                'min' => 'El año inicial no puede ser menor al año actual.',
                'max' => 'El año inicial no puede ser mayor a tres años del año actual.',
            ],
            'ano_fin' => [
                'required' => 'El año final es obligatorio.',
                'min' => 'El año final no puede ser menor al año actual.',
                'max' => 'El año final no puede ser mayor a tres años del año actual.',
            ],
        ])->validate();



        $varainte = CicloEscolar::where('ano_ini', $request->ano_ini)
                  ->where('ano_fin', $request->ano_fin)
                  ->where('periodo', $request->periodo)
                  ->where('descripcion', $request->descripcion)
                  ->where('abreviatura', $request->abreviatura)
                  ->where('denominacion', $request->denominacion)
                  ->where('date_ini', $request->date_ini)
                  ->where('date_fin', $request->date_fin);
        if($varainte->count()>1){
            Session::flash('message', ['content' => 'Ya existe un ciclo escolar con la misma combinación de valores.', 'type' => 'error']);
            return redirect()->back();
        }else if($varainte->count()==1){
            $idex = $varainte->get()[0]->id;
            if($idex!=$antes->id){
                Session::flash('message', ['content' => 'Ya existe un ciclo escolar con la misma combinación de valores.', 'type' => 'error']);
                return redirect()->back();
            }
        }

        try {

            $antes->ano_ini = $request->ano_ini;
            $antes->ano_fin = $request->ano_fin;
            $antes->periodo = $request->periodo;
            $antes->descripcion = $request->descripcion;
            $antes->abreviatura = $request->abreviatura;
            $antes->denominacion = $request->denominacion;
            $antes->codigo = $request->codigo;
            $antes->date_ini = $request->date_ini;
            $antes->date_fin = $request->date_fin;
            $antes->fecha_ini = "2024-12-02";
            $antes->fecha_fin = "2024-12-02";

    
            $antes->save();
            Session::flash('message', ['content' => 'Ciclo escolar actualizado con éxito', 'type' => 'success']);
            return redirect()->action([CicloEscolarController::class, 'index']);
        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3937', 'type' => 'error']);
            return redirect()->back();
        }

    }






    public function delete($id) {
        try {    

            $cic = CicloEscolar::find($id);
            $cic->activo = false;
            $cic->save();

            Session::flash('message', ['content' => 'Ciclo escolar eliminado con éxito', 'type' => 'success']);
            return redirect()->action([CicloEscolarController::class, 'index']);

        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }



    public function inactivo(Request $request){

        $data = CicloEscolar::where('activo',false)->get();


        return view('cicloescolar.inactivo',['data' => $data]);



    }



    public function active($id) {
        try {    

            $model = CicloEscolar::find($id);
            $model->activo = true;
            $model->save();

            Session::flash('message', ['content' => 'Ciclo escolar activado con éxito', 'type' => 'success']);
            return redirect()->action([CicloEscolarController::class, 'index']);
        }catch(Exception $ex){
    
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error 3174', 'type' => 'error']);
            return redirect()->back();
        }
    }




}
