<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Fretes;


class FretesController extends Controller
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
    public function busca(Request $request)
    {

        $items=Fretes::where("tiposfretes_id",$request->get("tiposfretes_id"))
        ->where("distanciainicial","<=",$request->get("distanciavendedor"))
        ->where("distanciafinal",">=",$request->get("distanciavendedor"))->first();
           

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
        $items=Fretes::create($request->all());

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
        $items=Fretes::where("id",$id)->where("empresa_id",$empresa->id)->get();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

      public function buscavalorfrete(Request $request)
    {
        $items=$valortipofrete=Fretes::where("tiposfretes_id",$this->produto->tiposfretes_id)->where("distanciainicial","<=",$this->distanciavendedor)->where("distanciafinal",">=",$this->distanciavendedor)->first();
           

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
        $fretes = new Fretes($items);
        $fretes->save();

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
        $items=Fretes::where("id",$id)->where("empresa_id",$empresa->id)->get();
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
                'distanciainicial' => $item->distanciainicial,
                'distanciafinal' => $item->distanciafinal,
                'valorfrete' => $item->valorfrete,
                'tiposfretes_id' => $item->tiposfretes_id
            ];
        };

    }
}
