<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $respuesta = User::create($inputs);
        if($respuesta){
           return response()->json([
            'data'=>$respuesta
        ]); 
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No se pudo registar el usuario'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            return response()->json([
                'data'=>$user
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'El usuario no existe'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $user->nombre = $request->nombre;
            $user->apellidos = $request->apellidos;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return response()->json([
                    'data'=>$user
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>'No se pudo actualizar el usuario'
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe el usuario'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $res = User::destroy($id);
            if($res){
              return response()->json([
                'data'=>$user,
                'mensaje'=>'Usuario eliminado con exito'
            ]);  
            }else{
                return response()->json([
                    'mensaje'=>'No se pudo eliminar el usuario'
                ]);
            }     
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'El usuario no existe'
            ]);
        }
    }
}
