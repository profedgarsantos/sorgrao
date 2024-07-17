<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Motoristas;


class MotoristasController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresaid)
    {
        $items=Motoristas::where("empresas_id",$empresaid)->get();

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
        $items=Motoristas::create($request->all());

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
    public function show(Empresas $empresa,$id)
    {
        $items=Motoristas::where("id",$id)->where("empresas_id",$empresa->id)->first();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

    public function buscaporusuario(Request $request)
    {
        $items=Motoristas::where("usuario_id",$request->get("usuario_id"))->first();

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
    public function update(Request $request, $id)
    {
        $items=$request->all();
        $motoristas = new Motoristas($items);
        $motoristas->save();

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
    public function destroy(Empresas $empresa,$id)
    {
        $items=Motoristas::where("id",$id)->where("empresas_id",$empresa->id)->first();
        $items->delete();

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
                'transportadora_id' => $item->transportadora,
                'user' => $item->user,
                'empresas_id' => $item->empresas_id
            ];
        };

    }
}
