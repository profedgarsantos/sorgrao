<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Expedicaos;


class ExpedicaosController extends Controller
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
        $items=Expedicaos::where("empresas_id",$empresaid)->get();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

    public function buscaexpedicaoporfechamento(Request $request,$empresaid)
    {
        $items=Expedicaos::where("empresas_id",$empresaid)->where("fechamento_id",$request->get("fechamento_id"))->get();

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
        $items=Expedicaos::create($request->all());

        return responder()
            ->success()
            ->respond();
    }

    
  

    

    public function buscaexpedicaoporlogistica(Request $request,$empresaid)
    {
        $items=Logisticas::where("empresas_id",$empresaid)->where("logistica_id",$request->get("logistica_id"))->first();

        return responder()
            ->success($items, $this->transformer())
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
        $items=Expedicaos::where("id",$id)->where("empresas_id",$empresaid)->get();

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
        

        $logistica=Expedicaos::where("id",$id)->where("empresas_id",$empresaid)->first();

        $logistica->fill($request->all());

        $logistica->save();

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
        $items=Expedicaos::where("id",$id)->where("empresas_id",$empresaid)->get();
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
                'fechamento' => $item->fechamento,
                'motoristas_id' => $item->motoristas_id,
                'veiculos_id' => $item->veiculos_id,
                'motorista' => $item->motorista,
                'veiculo' => $item->veiculo,
                'produto'=>$item->produto,
                'transportadora' => $item->veiculo->transportadora->user,
                'empresas_id' => $item->empresas_id,
                'disponibilidade' => $item->disponibilidade,
                'datasaida' => $item->datasaida,
                'emrecepcao' => $item->emrecepcao
            ];
        };

    }
}
