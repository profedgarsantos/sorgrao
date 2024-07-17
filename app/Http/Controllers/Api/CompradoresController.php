<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Compradores;


class CompradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresaid)
    {

        $user=auth()->user();
        if ($user->grupos_id==1 || $user->grupos_id==4) //admin e comissionado vem tudo
        {
            $items=Compradores::where("empresas_id",$empresaid)->get();
        }

        if ($user->grupos_id==2) //compradores ve só os deles
        {
            $items=Compradores::where("empresas_id",$empresaid)->where("usuario_id",$user->id)->first();
        }

       return responder()
        ->success($items, $this->transformer())
        ->respond();
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // pegar dados do formulario
           $items=Compradores::create($request->all());

           return responder()
           ->success()
           ->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresaid,$id)
    {
        $items=Compradores::where("usuario_id",$id)->where("empresas_id",$empresaid)->first();

        return responder()
        ->success($items, $this->transformer())
        ->respond();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$empresaid, $id)
    {

        $comprador=Compradores::where("id",$id)->where("empresa_id",$empresaid)->first();

        $comprador->fill($request->all());

        $comprador->save();
        
        return responder()
        ->success()
        ->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresaid,$id)
    {
        $comprador=Compradores::where("id",$id)->where("empresa_id",$empresaid)->first();
        $comprador->delete();

        return responder()
        ->success()
        ->respond();



        //
    }

      private function transformer()
     {
         return function ($item) {
             return [
                 'id' => $item->id,
                 'user' => $item->GetUsuario
             ];
         };

     }
}
