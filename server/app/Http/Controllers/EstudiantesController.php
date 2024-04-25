<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use GuzzleHttp\Promise\Is;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        if($respuesta){
           return response()->json([
            'data'=>$respuesta
        ]); 
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No se pudo registar el estudiante'
            ]);
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            return response()->json([
                'data'=>$estudiante
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'El estudiante no existe'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $estudiante->nombre = $request->nombre;
            $estudiante->apellidos = $request->apellidos;
            $estudiante->foto = $request->foto;
            if($estudiante->save()){
                return response()->json([
                    'data'=>$estudiante
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>'No se pudo actualizar el estudiante'
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe el estudiante'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $res = Estudiante::destroy($id);
            if($res){
              return response()->json([
                'data'=>$estudiante,
                'mensaje'=>'Estudiante eliminado con exito'
            ]);  
            }else{
                return response()->json([
                    'mensaje'=>'No se pudo eliminar el estudiante'
                ]);
            }     
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'El estudiante no existe'
            ]);
        }
    }
}
