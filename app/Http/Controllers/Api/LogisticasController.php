<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Logisticas;


class LogisticasController extends Controller
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
        $items=Logisticas::where("empresas_id",$empresaid)->get();

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
        $items=Logisticas::create($request->all());

        return responder()
            ->success()
            ->respond();
    }


    
    public function buscalogisticaporexpedicao(Request $request,$empresaid)
    {
        $items=Logisticas::where("empresas_id",$empresaid)->where("expedicao_id",$request->get("expedicao_id"))->first();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }
    

    public function buscalogisticasporfechamento(Request $request,$empresaid)
    {
        $items=Logisticas::where("empresas_id",$empresaid)->where("fechamento_id",$request->get("fechamento_id"))->get();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }
    
    public function buscalogisticaexpedidas(Request $request,$empresaid)
    {
        $items=Logisticas::where("empresas_id",$empresaid)->where("fechamento_id",$request->get("fechamento_id"))->get();

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
        $items=Logisticas::where("id",$id)->where("empresas_id",$empresaid)->get();

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
       

        $expedicao=Logisticas::where("id",$id)->where("empresas_id",$empresaid)->first();

        $expedicao->fill($request->all());

        $expedicao->save();

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
        $items=Logisticas::where("id",$id)->where("empresas_id",$empresaid)->get();
        $items->delete();

        return responder()
            ->success()
            ->respond();
    }

    private function transformer()
    {
        return function ($item) {
            return [
                 'id' => $item->id,
                'expedicao' => $item->expedicao,
                'fechamento' => $item->fechamento,
                'produto'=>$item->produto,
                'datarecepcao' => $item->datarecepcao,
                'pesoliquido' => $item->pesoliquido,
                'notafiscal' => $item->notafiscal,
                'created_at' => $item->created_at
            ];
        };

    }

   
}
